var mblEssen = mblEssen || {};
var slideIndex = 1;
mblEssen.modal = {
	init: function () {
		this.openModal();
		this.closeModal();
		this.changeSlides();
		this.currentSlide();
	},

	openModal: function () {
		const openModalBtn = document.querySelector(
			".feature-section span.mbl-modal-button"
		);
		if (openModalBtn == null) return;
		console.log(openModalBtn);
		openModalBtn.addEventListener("click", function () {
			document.getElementById("phone-images-modal").style.display =
				"block";
			document.querySelector("body").style.overflow = "hidden";
			mblEssen.modal.slideshow(1);
		});
	},

	closeModal: function () {
		const closeModalBtn = document.querySelector(
			".phone-images span.close-modal"
		);
		if (closeModalBtn == null) return;
		closeModalBtn.addEventListener("click", function () {
			document.getElementById("phone-images-modal").style.display =
				"none";
			document.querySelector("body").style.overflow = "auto";
		});
	},

	slideshow: function (n) {
		var i;
		var slides = document.getElementsByClassName("pim-slides");
		var dots = document.getElementsByClassName("dotb");
		// var captionText = document.getElementById("caption");
		if (n > slides.length) {
			slideIndex = 1;
		}
		if (n < 1) {
			slideIndex = slides.length;
		}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" active", "");
		}
		slides[slideIndex - 1].style.display = "block";
		dots[slideIndex - 1].className += " active";
		// captionText.innerHTML = dots[slideIndex - 1].alt;
	},

	changeSlides: function () {
		const prevBtn = document.querySelector(".phone-images .prev");
		const nextBtn = document.querySelector(".phone-images .next");
		var n;
		var $this = this;
		prevBtn.addEventListener("click", function (e) {
			e.preventDefault();
			n = -1;
			$this.slideshow((slideIndex += n));
		});
		nextBtn.addEventListener("click", function (e) {
			e.preventDefault();
			n = 1;
			$this.slideshow((slideIndex += n));
		});
	},

	currentSlide: function () {
		const dots = document.querySelectorAll(".dot-nav .dotb");
		var $this = this;
		dots.forEach(($v) => {
			var index = $v.getAttribute("data-index");
			$v.addEventListener("click", function () {
				$this.slideshow((slideIndex = parseInt(index)));
			});
		});
	},
};

/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @since 0.1
 *
 * @param {Function} fn Callback function to run.
 */
function mblEssenFrontDomReady(fn) {
	if (typeof fn !== "function") {
		return;
	}

	if (
		document.readyState === "interactive" ||
		document.readyState === "complete"
	) {
		return fn();
	}

	document.addEventListener("DOMContentLoaded", fn, false);
}

mblEssenFrontDomReady(function () {
	mblEssen.modal.init();
});
