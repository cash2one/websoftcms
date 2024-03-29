<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Yaml;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Tag\TaggedValue;

/**
 * Parser parses YAML strings to convert them to PHP arrays.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Parser
{
    const TAG_PATTERN = '(?P<tag>![\w!.\/:-]+)';
    const BLOCK_SCALAR_HEADER_PATTERN = '(?P<separator>\||>)(?P<modifiers>\+|\-|\d+|\+\d+|\-\d+|\d+\+|\d+\-)?(?P<comments> +#.*)?';

    private $offset = 0;
    private $totalNumberOfLines;
    private $lines = [];
    private $currentLineNb = -1;
    private $currentLine = '';
    private $refs = [];
    private $skippedLineNumbers = [];
    private $locallySkippedLineNumbers = [];

    public function __construct()
    {
        if (func_num_args() > 0) {
            @trigger_error(sprintf('The constructor arguments $offset, $totalNumberOfLines, $skippedLineNumbers of %s are deprecated and will be removed in 4.0', self::class), E_USER_DEPRECATED);

            $this->offset = func_get_arg(0);
            if (func_num_args() > 1) {
                $this->totalNumberOfLines = func_get_arg(1);
            }
            if (func_num_args() > 2) {
                $this->skippedLineNumbers = func_get_arg(2);
            }
        }
    }

    /**
     * Parses a YAML string to a PHP value.
     *
     * @param string $value A YAML string
     * @param int    $flags A bit field of PARSE_* constants to customize the YAML parser behavior
     *
     * @return mixed A PHP value
     *
     * @throws ParseException If the YAML is not valid
     */
    public function parse($value, $flags = 0)
    {
        if (is_bool($flags)) {
            @trigger_error('Passing a boolean flag to toggle exception handling is deprecated since version 3.1 and will be removed in 4.0. Use the Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE flag instead.', E_USER_DEPRECATED);

            if ($flags) {
                $flags = Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE;
            } else {
                $flags = 0;
            }
        }

        if (func_num_args() >= 3) {
            @trigger_error('Passing a boolean flag to toggle object support is deprecated since version 3.1 and will be removed in 4.0. Use the Yaml::PARSE_OBJECT flag instead.', E_USER_DEPRECATED);

            if (func_get_arg(2)) {
                $flags |= Yaml::PARSE_OBJECT;
            }
        }

        if (func_num_args() >= 4) {
            @trigger_error('Passing a boolean flag to toggle object for map support is deprecated since version 3.1 and will be removed in 4.0. Use the Yaml::PARSE_OBJECT_FOR_MAP flag instead.', E_USER_DEPRECATED);

            if (func_get_arg(3)) {
                $flags |= Yaml::PARSE_OBJECT_FOR_MAP;
            }
        }

        if (false === preg_match('//u', $value)) {
            throw new ParseException('The YAML value does not appear to be valid UTF-8.');
        }

        $this->refs = [];

        $mbEncoding = null;
        $e = null;
        $data = null;

        if (2 /* MB_OVERLOAD_STRING */ & (int) ini_get('mbstring.func_overload')) {
            $mbEncoding = mb_internal_encoding();
            mb_internal_encoding('UTF-8');
        }

        try {
            $data = $this->doParse($value, $flags);
        } catch (\Exception $e) {
        } catch (\Throwable $e) {
        }

        if (null !== $mbEncoding) {
            mb_internal_encoding($mbEncoding);
        }

        $this->lines = [];
        $this->currentLine = '';
        $this->refs = [];
        $this->skippedLineNumbers = [];
        $this->locallySkippedLineNumbers = [];

        if (null !== $e) {
            throw $e;
        }

        return $data;
    }

    private function doParse($value, $flags)
    {
        $this->currentLineNb = -1;
        $this->currentLine = '';
        $value = $this->cleanup($value);
        $this->lines = explode("\n", $value);
        $this->locallySkippedLineNumbers = [];

        if (null === $this->totalNumberOfLines) {
            $this->totalNumberOfLines = count($this->lines);
        }

        if (!$this->moveToNextLine()) {
            return null;
        }

        $data = [];
        $context = null;
        $allowOverwrite = false;

        while ($this->isCurrentLineEmpty()) {
            if (!$this->moveToNextLine()) {
                return null;
            }
        }

        // Resolves the tag and returns if end of the document
        if (null !== ($tag = $this->getLineTag($this->currentLine, $flags, false)) && !$this->moveToNextLine()) {
            return new TaggedValue($tag, '');
        }

        do {
            if ($this->isCurrentLineEmpty()) {
                continue;
            }

            // tab?
            if ("\t" === $this->currentLine[0]) {
                throw new ParseException('A YAML file cannot contain tabs as indentation.', $this->getRealCurrentLineNb() + 1, $this->currentLine);
            }

            $isRef = $mergeNode = false;
            if (self::preg_match('#^\-((?P<leadspaces>\s+)(?P<value>.+))?$#u', rtrim($this->currentLine), $values)) {
                if ($context && 'mapping' == $context) {
                    throw new ParseException('You cannot define a sequence item when in a mapping', $this->getRealCurrentLineNb() + 1, $this->currentLine);
                }
                $context = 'sequence';

                if (isset($values['value']) && self::preg_match('#^&(?P<ref>[^ ]+) *(?P<value>.*)#u', $values['value'], $matches)) {
                    $isRef = $matches['ref'];
                    $values['value'] = $matches['value'];
                }

                if (isset($values['value'][1]) && '?' === $values['value'][0] && ' ' === $values['value'][1]) {
                    @trigger_error('Starting an unquoted string with a question mark followed by a space is deprecated since version 3.3 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0.', E_USER_DEPRECATED);
                }

                // array
                if (!isset($values['value']) || '' == trim($values['value'], ' ') || 0 === strpos(ltrim($values['value'], ' '), '#')) {
                    $data[] = $this->parseBlock($this->getRealCurrentLineNb() + 1, $this->getNextEmbedBlock(null, true), $flags);
                } elseif (null !== $subTag = $this->getLineTag(ltrim($values['value'], ' '), $flags)) {
                    $data[] = new TaggedValue(
                        $subTag,
                        $this->parseBlock($this->getRealCurrentLineNb() + 1, $this->getNextEmbedBlock(null, true), $flags)
                    );
                } else {
                    if (isset($values['leadspaces'])
                        && self::preg_match('#^(?P<key>'.Inline::REGEX_QUOTED_STRING.'|[^ \'"\{\[].*?) *\:(\s+(?P<value>.+?))?\s*$#u', $this->trimTag($values['value']), $matches)
                    ) {
                        // this is a compact notation element, add to next block and parse
                        $block = $values['value'];
                        if ($this->isNextLineIndented()) {
                            $block .= "\n".$this->getNextEmbedBlock($this->getCurrentLineIndentation() + strlen($values['leadspaces']) + 1);
                        }

                        $data[] = $this->parseBlock($this->getRealCurrentLineNb(), $block, $flags);
                    } else {
                        $data[] = $this->parseValue($values['value'], $flags, $context);
                    }
                }
                if ($isRef) {
                    $this->refs[$isRef] = end($data);
                }
            } elseif (
                self::preg_match('#^(?P<key>'.Inline::REGEX_QUOTED_STRING.'|(?:!?!php/const:)?(?:![^\s]++\s++)?[^ \'"\[\{!].*?) *\:(\s++(?P<value>.+))?$#u', rtrim($this->currentLine), $values)
                && (false === strpos($values['key'], ' #') || in_array($values['key'][0], array('"', "'")))
            ) {
                if ($context && 'sequence' == $context) {
                    throw new ParseException('You cannot define a mapping item when in a sequence', $this->currentLineNb + 1, $this->currentLine);
                }
                $context = 'mapping';

                // force correct settings
                Inline::parse(null, $flags, $this->refs);
                try {
                    Inline::$parsedLineNumber = $this->getRealCurrentLineNb();
                    $i = 0;
                    $evaluateKey = !(Yaml::PARSE_KEYS_AS_STRINGS & $flags);

                    // constants in key will be evaluated anyway
                    if (isset($values['key'][0]) && '!' === $values['key'][0] && Yaml::PARSE_CONSTANT & $flags) {
                        $evaluateKey = true;
                    }

                    $key = Inline::parseScalar($values['key'], 0, null, $i, $evaluateKey);
                } catch (ParseException $e) {
                    $e->setParsedLine($this->getRealCurrentLineNb() + 1);
                    $e->setSnippet($this->currentLine);

                    throw $e;
                }

                if (!(Yaml::PARSE_KEYS_AS_STRINGS & $flags) && !is_string($key) && !is_int($key)) {
                    $keyType = is_numeric($key) ? 'numeric key' : 'non-string key';
                    @trigger_error(sprintf('Implicit casting of %s to string is deprecated since version 3.3 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0. Pass the PARSE_KEYS_AS_STRINGS flag to explicitly enable the type casts.', $keyType), E_USER_DEPRECATED);
                }

                // Convert float keys to strings, to avoid being converted to integers by PHP
                if (is_float($key)) {
                    $key = (string) $key;
                }

                if ('<<' === $key) {
                    $mergeNode = true;
                    $allowOverwrite = true;
                    if (isset($values['value']) && 0 === strpos($values['value'], '*')) {
                        $refName = substr(rtrim($values['value']), 1);
                        if (!array_key_exists($refName, $this->refs)) {
                            throw new ParseException(sprintf('Reference "%s" does not exist.', $refName), $this->getRealCurrentLineNb() + 1, $this->currentLine);
                        }

                        $refValue = $this->refs[$refName];

                        if (!is_array($refValue)) {
                            throw new ParseException('YAML merge keys used with a scalar value instead of an array.', $this->getRealCurrentLineNb() + 1, $this->currentLine);
                        }

                        $data += $refValue; // array union
                    } else {
                        if (isset($values['value']) && $values['value'] !== '') {
                            $value = $values['value'];
                        } else {
                            $value = $this->getNextEmbedBlock();
                        }
                        $parsed = $this->parseBlock($this->getRealCurrentLineNb() + 1, $value, $flags);

                        if (!is_array($parsed)) {
                            throw new ParseException('YAML merge keys used with a scalar value instead of an array.', $this->getRealCurrentLineNb() + 1, $this->currentLine);
                        }

                        if (isset($parsed[0])) {
                            // If the value associated with the merge key is a sequence, then this sequence is expected to contain mapping nodes
                            // and each of these nodes is merged in turn according to its order in the sequence. Keys in mapping nodes earlier
                            // in the sequence override keys specified in later mapping nodes.
                            foreach ($parsed as $parsedItem) {
                                if (!is_array($parsedItem)) {
                                    throw new ParseException('Merge items must be arrays.', $this->getRealCurrentLineNb() + 1, $parsedItem);
                                }

                                $data += $parsedItem; // array union
                            }
                        } else {
                            // If the value associated with the key is a single mapping node, each of its key/value pairs is inserted into the
                            // current mapping, unless the key already exists in it.
                            $data += $parsed; // array union
                        }
                    }
                } elseif (isset($values['value']) && self::preg_match('#^&(?P<ref>[^ ]++) *+(?P<value>.*)#u', $values['value'], $matches)) {
                    $isRef = $matches['ref'];
                    $values['value'] = $matches['value'];
                }

                $subTag = null;
                if ($mergeNode) {
                    // Merge keys
                } elseif (!isset($values['value']) || '' === $values['value'] || 0 === strpos($values['value'], '#') || (null !== $subTag = $this->getLineTag($values['value'], $flags))) {
                    // hash
                    // if next line is less indented or equal, then it means that the current value is null
                    if (!$this->isNextLineIndented() && !$this->isNextLineUnIndentedCollection()) {
                        // Spec: Keys MUST be unique; first one wins.
                        // But overwriting is allowed when a merge node is used in current block.
                        if ($allowOverwrite || !isset($data[$key])) {
                            if (null !== $subTag) {
                                $data[$key] = new TaggedValue($subTag, '');
                            } else {
                                $data[$key] = null;
                            }
                        } else {
                            @trigger_error(sprintf('Duplicate key "%s" detected whilst parsing YAML. Silent handling of duplicate mapping keys in YAML is deprecated since version 3.2 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0.', $key), E_USER_DEPRECATED);
                        }
                    } else {
                        // remember the parsed line number here in case we need it to provide some contexts in error messages below
                        $realCurrentLineNbKey = $this->getRealCurrentLineNb();
                        $value = $this->parseBlock($this->getRealCurrentLineNb() + 1, $this->getNextEmbedBlock(), $flags);
                        // Spec: Keys MUST be unique; first one wins.
                        // But overwriting is allowed when a merge node is used in current block.
                        if ($allowOverwrite || !isset($data[$key])) {
                            if (null !== $subTag) {
                                $data[$key] = new TaggedValue($subTag, $value);
                            } else {
                                $data[$key] = $value;
                            }
                        } else {
                            @trigger_error(sprintf('Duplicate key "%s" detected whilst parsing YAML. Silent handling of duplicate mapping keys in YAML is deprecated since version 3.2 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0.', $key), E_USER_DEPRECATED);
                        }
                    }
                } else {
                    $value = $this->parseValue(rtrim($values['value']), $flags, $context);
                    // Spec: Keys MUST be unique; first one wins.
                    // But overwriting is allowed when a merge node is used in current block.
                    if ($allowOverwrite || !isset($data[$key])) {
                        $data[$key] = $value;
                    } else {
                        @trigger_error(sprintf('Duplicate key "%s" detected whilst parsing YAML. Silent handling of duplicate mapping keys in YAML is deprecated since version 3.2 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0.', $key), E_USER_DEPRECATED);
                    }
                }
                if ($isRef) {
                    $this->refs[$isRef] = $data[$key];
                }
            } else {
                // multiple documents are not supported
                if ('---' === $this->currentLine) {
                    throw new ParseException('Multiple documents are not supported.', $this->currentLineNb + 1, $this->currentLine);
                }

                if (isset($this->currentLine[1]) && '?' === $this->currentLine[0] && ' ' === $this->currentLine[1]) {
                    @trigger_error('Starting an unquoted string with a question mark followed by a space is deprecated since version 3.3 and will throw \Symfony\Component\Yaml\Exception\ParseException in 4.0.', E_USER_DEPRECATED);
                }

                // 1-liner optionally followed by newline(s)
                if (is_string($value) && $this->lines[0] === trim($value)) {
                    try {
                        Inline::$parsedLineNumber = $this->getRealCurrentLineNb();
                        $value = Inline::parse($this->lines[0], $flags, $this->refs);
                    } catch (ParseException $e) {
                        $e->setParsedLine($this->getRealCurrentLineNb() + 1);
                        $e->setSnippet($this->currentLine);

                        throw $e;
                    }

                    return $value;
                }

                // try to parse the value as a multi-line string as a last resort
                if (0 === $this->currentLineNb) {
                    $parseError = false;
                    $previousLineWasNewline = false;
                    $value = '';

                    foreach ($this->lines as $line) {
                        try {
                            if (isset($line[0]) && ('"' === $line[0] || "'" === $line[0])) {
                                $parsedLine = $line;
                            } else {
                                $parsedLine = Inline::parse($line, $flags, $this->refs);
                            }

                            if (!is_string($parsedLine)) {
                                $parseError = true;
                                break;
                            }

                            if ('' === trim($parsedLine)) {
                                $value .= "\n";
                                $previousLineWasNewline = true;
                            } elseif ($previousLineWasNewline) {
                                $value .= trim($parsedLine);
                                $previousLineWasNewline = false;
                            } else {
                                $value .= ' '.trim($parsedLine);
                                $previousLineWasNewline = false;
                            }
                        } catch (ParseException $e) {
                            $parseError = true;
                            break;
                        }
                    }

                    if (!$parseError) {
                        return trim($value);
                    }
                }

                throw new ParseException('Unable to parse.', $this->getRealCurrentLineNb() + 1, $this->currentLine);
            }
        } while ($this->moveToNextLine());

        if (null !== $tag) {
            $data = new TaggedValue($tag, $data);
        }

        if (Yaml::PARSE_OBJECT_FOR_MAP & $flags && !is_object($data) && 'mapping' === $context) {
            $object = new \stdClass();

            foreach ($data as $key => $value) {
                $object->$key = $value;
            }

            $data = $object;
        }

        return empty($data) ? null : $data;
    }

    private function parseBlock($offset, $yaml, $flags)
    {
        $skippedLineNumbers = $this->skippedLineNumbers;

        foreach ($this->locallySkippedLineNumbers as $lineNumber) {
            if ($lineNumber < $offset) {
                continue;
            }

            $skippedLineNumbers[] = $lineNumber;
        }

        $parser = new self();
        $parser->offset = $offset;
        $parser->totalNumberOfLines = $this->totalNumberOfLines;
        $parser->skippedLineNumbers = $skippedLineNumbers;
        $parser->refs = &$this->refs;

        return $parser->doParse($yaml, $flags);
    }

    /**
     * Returns the current line number (takes the offset into account).
     *
     * @return int The current line number
     */
    private function getRealCurrentLineNb()
    {
        $realCurrentLineNumber = $this->currentLineNb + $this->offset;

        foreach ($this->skippedLineNumbers as $skippedLineNumber) {
            if ($skippedLineNumber > $realCurrentLineNumber) {
                break;
            }

            ++$realCurrentLineNumber;
        }

        return $realCurrentLineNumber;
    }

    /**
     * Returns the current line indentation.
     *
     * @return int The current line indentation
     */
    private function getCurrentLineIndentation()
    {
        return strlen($this->currentLine) - strlen(ltrim($this->currentLine, ' '));
    }

    /**
     * Returns the next embed block of YAML.
     *
     * @param int  $indentation The indent level at which the block is to be read, or null for default
     * @param bool $inSequence  True if the enclosing data structure is a sequence
     *
     * @return string A YAML string
     *
     * @throws ParseException When indentation problem are detected
     */
    private function getNextEmbedBlock($indentation = null, $inSequence = false)
    {
        $oldLineIndentation = $this->getCurrentLineIndentation();
        $blockScalarIndentations = [];

        if ($this->isBlockScalarHeader()) {
            $blockScalarIndentations[] = $oldLineIndentation;
        }

        if (!$this->moveToNextLine()) {
            return;
        }

        if (null === $indentation) {
            $newIndent = $this->getCurrentLineIndentation();

            $unindentedEmbedBlock = $this->isStringUnIndentedCollectionItem();

            if (!$this->isCurrentLineEmpty() && 0 === $newIndent && !$unindentedEmbedBlock) {
                throw new ParseException('Indentation problem.', $this->getRealCurrentLineNb() + 1, $this->currentLine);
            }
        } else {
            $newIndent = $indentation;
        }

        $data = [];
        if ($this->getCurrentLineIndentation() >= $newIndent) {
            $data[] = substr($this->currentLine, $newIndent);
        } else {
            $this->moveToPreviousLine();

            return;
        }

        if ($inSequence && $oldLineIndentation === $newIndent && isset($data[0][0]) && '-' === $data[0][0]) {
            // the previous line contained a dash but no item content, this line is a sequence item with the same indentation
            // and therefore no nested list or mapping
            $this->moveToPreviousLine();

            return;
        }

        $isItUnindentedCollection = $this->isStringUnIndentedCollectionItem();

        if (empty($blockScalarIndentations) && $this->isBlockScalarHeader()) {
            $blockScalarIndentations[] = $this->getCurrentLineIndentation();
        }

        $previousLineIndentation = $this->getCurrentLineIndentation();

        while ($this->moveToNextLine()) {
            $indent = $this->getCurrentLineIndentation();

            // terminate all block scalars that are more indented than the current line
            if (!empty($blockScalarIndentations) && $indent < $previousLineIndentation && trim($this->currentLine) !== '') {
                foreach ($blockScalarIndentations as $key => $blockScalarIndentation) {
                    if ($blockScalarIndentation >= $indent) {
                        unset($blockScalarIndentations[$key]);
                    }
                }
            }

            if (empty($blockScalarIndentations) && !$this->isCurrentLineComment() && $this->isBlockScalarHeader()) {
                $blockScalarIndentations[] = $indent;
            }

            $previousLineIndentation = $indent;

            if ($isItUnindentedCollection && !$this->isCurrentLineEmpty() && !$this->isStringUnIndentedCollectionItem() && $newIndent === $indent) {
                $this->moveToPreviousLine();
                break;
            }

            if ($this->isCurrentLineBlank()) {
                $data[] = substr($this->currentLine, $newIndent);
                continue;
            }

            // we ignore "comment" lines only when we are not inside a scalar block
            if (empty($blockScalarIndentations) && $this->isCurrentLineComment()) {
                // remember ignored comment lines (they are used later in nested
                // parser calls to determine real line numbers)
                //
                // CAUTION: beware to not populate the global property here as it
                // will otherwise influence the getRealCurrentLineNb() call here
                // for consecutive comment lines and subsequent embedded blocks
                $this->locallySkippedLineNumbers[] = $this->getRealCurrentLineNb();

                continue;
            }

            if ($indent >= $newIndent) {
                $data[] = substr($this->currentLine, $newIndent);
            } elseif (0 == $indent) {
                $this->moveToPreviousLine();

                break;
            } else {
                throw new ParseException('Indentation problem.', $this->getRealCurrentLineNb() + 1, $this->currentLine);
            }
        }

        return implode("\n", $data);
    }

    /**
     * Moves the parser to the next line.
     *
     * @return bool
     */
    private function moveToNextLine()
    {
        if ($this->currentLineNb >= count($this->lines) - 1) {
            return false;
        }

        $this->currentLine = $this->lines[++$this->currentLineNb];

        return true;
    }

    /**
     * Moves the parser to the previous line.
     *
     * @return bool
     */
    private function moveToPreviousLine()
    {
        if ($this->currentLineNb < 1) {
            return false;
        }

        $this->currentLine = $this->lines[--$this->currentLineNb];

        return true;
    }

    /**
     * Parses a YAML value.
     *
     * @param string $value   A YAML value
     * @param int    $flags   A bit field of PARSE_* constants to customize the YAML parser behavior
     * @param string $context The parser context (either sequence or mapping)
     *
     * @return mixed A PHP value
     *
     * @throws ParseException When reference does not exist
     */
    private function parseValue($value, $flags, $context)
    {
        if (0 === strpos($value, '*')) {
            if (false !== $pos = strpos($value, '#')) {
                $value = substr($value, 1, $pos - 2);
            } else {
                $value = substr($value, 1);
            }

            if (!array_key_exists($value, $this->refs)) {
                throw new ParseException(sprintf('Reference "%s" does not exist.', $value), $this->currentLineNb + 1, $this->currentLine);
            }

            return $this->refs[$value];
        }

        if (self::preg_match('/^(?:'.self::TAG_PATTERN.' +)?'.self::BLOCK_SCALAR_HEADER_PATTERN.'$/', $value, $matches)) {
            $modifiers = isset($matches['modifiers']) ? $matches['modifiers'] : '';

            $data = $this->parseBlockScalar($matches['separator'], preg_replace('#\d+#', '', $modifiers), (int) abs($modifiers));

            if ('' !== $matches['tag']) {
                if ('!!binary' === $matches['tag']) {
                    return Inline::evaluateBinaryScalar($data);
                } elseif ('!' !== $matches['tag']) {
                    @trigger_error(sprintf('Using the custom tag "%s" for the value "%s" is deprecated since version 3.3. It will be replaced by an instance of %s in 4.0.', $matches['tag'], $data, TaggedValue::class), E_USER_DEPRECATED);
                }
            }

            return $data;
        }

        try {
            $quotation = '' !== $value && ('"' === $value[0] || "'" === $value[0]) ? $value[0] : null;

            // do not take following lines into account when the current line is a quoted single line value
            if (null !== $quotation && self::preg_match('/^'.$quotation.'.*'.$quotation.'(\s*#.*)?$/', $value)) {
                return Inline::parse($value, $flags, $this->refs);
            }

            while ($this->moveToNextLine()) {
                // unquoted strings end before the first unindented line
                if (null === $quotation && $this->getCurrentLineIndentation() === 0) {
                    $this->moveToPreviousLine();

                    break;
                }

                $value .= ' '.trim($this->currentLine);

                // quoted string values end with a line that is terminated with the quotation character
                if ('' !== $this->currentLine && substr($this->currentLine, -1) === $quotation) {
                    break;
                }
            }

            Inline::$parsedLineNumber = $this->getRealCurrentLineNb();
            $parsedValue = Inline::parse($value, $flags, $this->refs);

            if ('mapping' === $context && is_string($parsedValue) && '"' !== $value[0] && "'" !== $value[0] && '[' !== $value[0] && '{' !== $value[0] && '!' !== $value[0] && false !== strpos($parsedValue, ': ')) {
                throw new ParseException('A colon cannot be used in an unquoted mapping value.');
            }

            return $parsedValue;
        } catch (ParseException $e) {
            $e->setParsedLine($this->getRealCurrentLineNb() + 1);
            $e->setSnippet($this->currentLine);

            throw $e;
        }
    }

    /**
     * Parses a block scalar.
     *
     * @param string $style       The style indicator that was used to begin this block scalar (| or >)
     * @param string $chomping    The chomping indicator that was used to begin this block scalar (+ or -)
     * @param int    $indentation The indentation indicator that was used to begin this block scalar
     *
     * @return string The text value
     */
    private function parseBlockScalar($style, $chomping = '', $indentation = 0)
    {
        $notEOF = $this->moveToNextLine();
        if (!$notEOF) {
            return '';
        }

        $isCurrentLineBlank = $this->isCurrentLineBlank();
        $blockLines = [];

        // leading blank lines are consumed before determining indentation
        while ($notEOF && $isCurrentLineBlank) {
            // newline only if not EOF
            if ($notEOF = $this->moveToNextLine()) {
                $blockLines[] = '';
                $isCurrentLineBlank = $this->isCurrentLineBlank();
            }
        }

        // determine indentation if not specified
        if (0 === $indentation) {
            if (self::preg_match('/^ +/', $this->currentLine, $matches)) {
                $indentation = strlen($matches[0]);
            }
        }

        if ($indentation > 0) {
            $pattern = sprintf('/^ {%d}(.*)$/', $indentation);

            while (
                $notEOF && (
                    $isCurrentLineBlank ||
                    self::preg_match($pattern, $this->currentLine, $matches)
                )
            ) {
                if ($isCurrentLineBlank && strlen($this->currentLine) > $indentation) {
                    $blockLines[] = substr($this->currentLine, $indentation);
                } elseif ($isCurrentLineBlank) {
                    $blockLines[] = '';
                } else {
                    $blockLines[] = $matches[1];
                }

                // newline only if not EOF
                if ($notEOF = $this->moveToNextLine()) {
                    $isCurrentLineBlank = $this->isCurrentLineBlank();
                }
            }
        } elseif ($notEOF) {
            $blockLines[] = '';
        }

        if ($notEOF) {
            $blockLines[] = '';
            $this->moveToPreviousLine();
        } elseif (!$notEOF && !$this->isCurrentLineLastLineInDocument()) {
            $blockLines[] = '';
        }

        // folded style
        if ('>' === $style) {
            $text = '';
            $previousLineIndented = false;
            $previousLineBlank = false;

            for ($i = 0, $blockLinesCount = count($blockLines); $i < $blockLinesCount; ++$i) {
                if ('' === $blockLines[$i]) {
                    $text .= "\n";
                    $previousLineIndented = false;
                    $previousLineBlank = true;
                } elseif (' ' === $blockLines[$i][0]) {
                    $text .= "\n".$blockLines[$i];
                    $previousLineIndented = true;
                    $previousLineBlank = false;
                } elseif ($previousLineIndented) {
                    $text .= "\n".$blockLines[$i];
                    $previousLineIndented = false;
                    $previousLineBlank = false;
                } elseif ($previousLineBlank || 0 === $i) {
                    $text .= $blockLines[$i];
                    $previousLineIndented = false;
                    $previousLineBlank = false;
                } else {
                    $text .= ' '.$blockLines[$i];
                    $previousLineIndented = false;
                    $previousLineBlank = false;
                }
            }
        } else {
            $text = implode("\n", $blockLines);
        }

        // deal with trailing newlines
        if ('' === $chomping) {
            $text = preg_replace('/\n+$/', "\n", $text);
        } elseif ('-' === $chomping) {
            $text = preg_replace('/\n+$/', '', $text);
        }

        return $text;
    }

    /**
     * Returns true if the next line is indented.
     *
     * @return bool Returns true if the next line is indented, false otherwise
     */
    private function isNextLineIndented()
    {
        $currentIndentation = $this->getCurrentLineIndentation();
        $EOF = !$this->moveToNextLine();

        while (!$EOF && $this->isCurrentLineEmpty()) {
            $EOF = !$this->moveToNextLine();
        }

        if ($EOF) {
            return false;
        }

        $ret = $this->getCurrentLineIndentation() > $currentIndentation;

        $this->moveToPreviousLine();

        return $ret;
    }

    /**
     * Returns true if the current line is blank or if it is a comment line.
     *
     * @return bool Returns true if the current line is empty or if it is a comment line, false otherwise
     */
    private function isCurrentLineEmpty()
    {
        return $this->isCurrentLineBlank() || $this->isCurrentLineComment();
    }

    /**
     * Returns true if the current line is blank.
     *
     * @return bool Returns true if the current line is blank, false otherwise
     */
    private function isCurrentLineBlank()
    {
        return '' == trim($this->currentLine, ' ');
    }

    /**
     * Returns true if the current line is a comment line.
     *
     * @return bool Returns true if the current line is a comment line, false otherwise
     */
    private function isCurrentLineComment()
    {
        //checking explicitly the first char of the trim is faster than loops or strpos
        $ltrimmedLine = ltrim($this->currentLine, ' ');

        return '' !== $ltrimmedLine && $ltrimmedLine[0] === '#';
    }

    private function isCurrentLineLastLineInDocument()
    {
        return ($this->offset + $this->currentLineNb) >= ($this->totalNumberOfLines - 1);
    }

    /**
     * Cleanups a YAML string to be parsed.
     *
     * @param string $value The input YAML string
     *
     * @return string A cleaned up YAML string
     */
    private function cleanup($value)
    {
        $value = str_replace(array("\r\n", "\r"), "\n", $value);

        // strip YAML header
        $count = 0;
        $value = preg_replace('#^\%YAML[: ][\d\.]+.*\n#u', '', $value, -1, $count);
        $this->offset += $count;

        // remove leading comments
        $trimmedValue = preg_replace('#^(\#.*?\n)+#s', '', $value, -1, $count);
        if ($count == 1) {
            // items have been removed, update the offset
            $this->offset += substr_count($value, "\n") - substr_count($trimmedValue, "\n");
            $value = $trimmedValue;
        }

        // remove start of the document marker (---)
        $trimmedValue = preg_replace('#^\-\-\-.*?\n#s', '', $value, -1, $count);
        if ($count == 1) {
            // items have been removed, update the offset
            $this->offset += substr_count($value, "\n") - substr_count($trimmedValue, "\n");
            $value = $trimmedValue;

            // remove end of the document marker (...)
            $value = preg_replace('#\.\.\.\s*$#', '', $value);
        }

        return $value;
    }

    /**
     * Returns true if the next line starts unindented collection.
     *
     * @return bool Returns true if the next line starts unindented collection, false otherwise
     */
    private function isNextLineUnIndentedCollection()
    {
        $currentIndentation = $this->getCurrentLineIndentation();
        $notEOF = $this->moveToNextLine();

        while ($notEOF && $this->isCurrentLineEmpty()) {
            $notEOF = $this->moveToNextLine();
        }

        if (false === $notEOF) {
            return false;
        }

        $ret = $this->getCurrentLineIndentation() === $currentIndentation && $this->isStringUnIndentedCollectionItem();

        $this->moveToPreviousLine();

        return $ret;
    }

    /**
     * Returns true if the string is un-indented collection item.
     *
     * @return bool Returns true if the string is un-indented collection item, false otherwise
     */
    private function isStringUnIndentedCollectionItem()
    {
        return '-' === rtrim($this->currentLine) || 0 === strpos($this->currentLine, '- ');
    }

    /**
     * Tests whether or not the current line is the header of a block scalar.
     *
     * @return bool
     */
    private function isBlockScalarHeader()
    {
        return (bool) self::preg_match('~'.self::BLOCK_SCALAR_HEADER_PATTERN.'$~', $this->currentLine);
    }

    /**
     * A local wrapper for `preg_match` which will throw a ParseException if there
     * is an internal error in the PCRE engine.
     *
     * This avoids us needing to check for "false" every time PCRE is used
     * in the YAML engine
     *
     * @throws ParseException on a PCRE internal error
     *
     * @see preg_last_error()
     *
     * @internal
     */
    public static function preg_match($pattern, $subject, &$matches = null, $flags = 0, $offset = 0)
    {
        if (false === $ret = preg_match($pattern, $subject, $matches, $flags, $offset)) {
            switch (preg_last_error()) {
                case PREG_INTERNAL_ERROR:
                    $error = 'Internal PCRE error.';
                    break;
                case PREG_BACKTRACK_LIMIT_ERROR:
                    $error = 'pcre.backtrack_limit reached.';
                    break;
                case PREG_RECURSION_LIMIT_ERROR:
                    $error = 'pcre.recursion_limit reached.';
                    break;
                case PREG_BAD_UTF8_ERROR:
                    $error = 'Malformed UTF-8 data.';
                    break;
                case PREG_BAD_UTF8_OFFSET_ERROR:
                    $error = 'Offset doesn\'t correspond to the begin of a valid UTF-8 code point.';
                    break;
                default:
                    $error = 'Error.';
            }

            throw new ParseException($error);
        }

        return $ret;
    }

    /**
     * Trim the tag on top of the value.
     *
     * Prevent values such as `!foo {quz: bar}` to be considered as
     * a mapping block.
     */
    private function trimTag($value)
    {
        if ('!' === $value[0]) {
            return ltrim(substr($value, 1, strcspn($value, " \r\n", 1)), ' ');
        }

        return $value;
    }

    private function getLineTag($value, $flags, $nextLineCheck = true)
    {
        if ('' === $value || '!' !== $value[0] || 1 !== self::preg_match('/^'.self::TAG_PATTERN.' *( +#.*)?$/', $value, $matches)) {
            return;
        }

        if ($nextLineCheck && !$this->isNextLineIndented()) {
            return;
        }

        $tag = substr($matches['tag'], 1);

        // Built-in tags
        if ($tag && '!' === $tag[0]) {
            throw new ParseException(sprintf('The built-in tag "!%s" is not implemented.', $tag));
        }

        if (Yaml::PARSE_CUSTOM_TAGS & $flags) {
            return $tag;
        }

        throw new ParseException(sprintf('Tags support is not enabled. You must use the flag `Yaml::PARSE_CUSTOM_TAGS` to use "%s".', $matches['tag']));
    }
}
