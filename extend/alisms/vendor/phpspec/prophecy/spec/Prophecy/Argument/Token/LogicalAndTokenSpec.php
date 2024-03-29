<?php

namespace spec\Prophecy\Argument\Token;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Argument\Token\TokenInterface;

class LogicalAndTokenSpec extends ObjectBehavior
{
    function it_implements_TokenInterface()
    {
        $this->beConstructedWith([]);
        $this->shouldBeAnInstanceOf('Prophecy\Argument\Token\TokenInterface');
    }

    function it_is_not_last()
    {
        $this->beConstructedWith([]);
        $this->shouldNotBeLast();
    }

    function it_generates_string_representation_from_all_tokens_imploded(
        TokenInterface $token1,
        TokenInterface $token2,
        TokenInterface $token3
    ) {
        $token1->__toString()->willReturn('token_1');
        $token2->__toString()->willReturn('token_2');
        $token3->__toString()->willReturn('token_3');

        $this->beConstructedWith(array($token1, $token2, $token3));
        $this->__toString()->shouldReturn('bool(token_1 AND token_2 AND token_3)');
    }

    function it_wraps_non_token_arguments_into_ExactValueToken()
    {
        $this->beConstructedWith(array(15, '1985'));
        $this->__toString()->shouldReturn("bool(exact(15) AND exact(\"1985\"))");
    }

    function it_scores_the_maximum_score_from_all_scores_returned_by_tokens(TokenInterface $token1, TokenInterface $token2)
    {
        $token1->scoreArgument(1)->willReturn(10);
        $token2->scoreArgument(1)->willReturn(5);
        $this->beConstructedWith(array($token1, $token2));
        $this->scoreArgument(1)->shouldReturn(10);
    }

    function it_does_not_score_if_there_are_no_arguments_or_tokens()
    {
        $this->beConstructedWith([]);
        $this->scoreArgument('any')->shouldReturn(false);
    }

    function it_does_not_score_if_either_of_tokens_does_not_score(TokenInterface $token1, TokenInterface $token2)
    {
        $token1->scoreArgument(1)->willReturn(10);
        $token1->scoreArgument(2)->willReturn(false);

        $token2->scoreArgument(1)->willReturn(false);
        $token2->scoreArgument(2)->willReturn(10);

        $this->beConstructedWith(array($token1, $token2));

        $this->scoreArgument(1)->shouldReturn(false);
        $this->scoreArgument(2)->shouldReturn(false);
    }
}
