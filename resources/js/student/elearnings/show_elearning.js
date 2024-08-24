document.addEventListener("DOMContentLoaded", () => {
    const elements = {
        materials: document.querySelectorAll(".material-title"),
        mainThumbnail: document.getElementById("main-thumbnail"),
        mainVideoContainer: document.getElementById("main-video-container"),
        mainVideo: document.getElementById("main-video"),
        mainTitle: document.getElementById("main-title"),
        mainDescription: document.getElementById("main-description"),
        backToElearning: document.getElementById("back-to-elearning"),
        modal: document.getElementById("material-modal"),
        modalTitle: document.getElementById("modal-title"),
        modalDescription: document.getElementById("modal-description"),
        modalVideo: document.getElementById("modal-video"),
        modalClose: document.querySelector(".close"),
    };

    const {
        materials,
        mainThumbnail,
        mainVideoContainer,
        mainVideo,
        mainTitle,
        mainDescription,
        backToElearning,
        modal,
        modalClose,
    } = elements;

    // Function to extract YouTube video ID from URL
    const getYouTubeVideoId = (url) => {
        const match = url.match(
            /(?:youtu.be\/|v\/|embed\/|watch\?v=)([^#\&\?]*).*/
        );
        return match ? match[1] : null;
    };

    // Material click event handler
    const onMaterialClick = function () {
        const videoUrl = this.getAttribute("data-video");
        const title = this.getAttribute("data-title");
        const description = this.getAttribute("data-description");

        mainThumbnail.classList.add("d-none");
        mainVideoContainer.classList.remove("d-none");
        mainVideo.src = `https://www.youtube.com/embed/${getYouTubeVideoId(
            videoUrl
        )}`;

        mainTitle.innerText = title;
        mainDescription.innerHTML = description;
        backToElearning.classList.remove("d-none");

        materials.forEach((material) =>
            material.classList.remove("material-title-active")
        );
        this.classList.add("material-title-active");
    };

    materials.forEach((material) =>
        material.addEventListener("click", onMaterialClick)
    );

    // Back to elearning event handler
    backToElearning.addEventListener("click", (event) => {
        event.preventDefault();
        mainVideoContainer.classList.add("d-none");
        mainThumbnail.classList.remove("d-none");

        mainTitle.innerText = elearningTitle;
        mainDescription.innerHTML = elearningDescription;
        backToElearning.classList.add("d-none");
    });

    // Modal close event handler
    modalClose.addEventListener("click", () => {
        modal.classList.add("d-none");
        modalVideo.src = "";
    });

    // Close modal if clicking outside of it
    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.classList.add("d-none");
            modalVideo.src = "";
        }
    });

    // Initialize rating widget if exists
    if ($(".basic-ratings").length) {
        $(".basic-ratings")
            .rateYo({
                rtl: isRtl,
                rating: typeof ratingExists !== "undefined" ? ratingExists : 0,
            })
            .on("rateyo.set", (e, data) => {
                $(this).siblings('input[name="rating"]').val(data.rating);
            });
    }
});
