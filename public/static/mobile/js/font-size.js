 (function() {
	var b = document.documentElement,
		a = function() {
			var a = b.getBoundingClientRect().width;
			b.style.fontSize = 0.0625 * (750 <= a ? 750 : a) + "px";
		},
		c = null;
	window.addEventListener("resize", function() {
		clearTimeout(c);
		c = setTimeout(a, 300)
	});
	a()
})();