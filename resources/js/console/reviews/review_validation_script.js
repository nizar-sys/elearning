document.addEventListener("DOMContentLoaded", () => {
    if ($(".basic-ratings")) {
        $(".basic-ratings")
            .rateYo({
                rtl: isRtl,
                rating: typeof ratingExists !== "undefined" ? ratingExists : 0,
            })
            .on("rateyo.set", function (e, data) {
                $('input[name="rating"]').val(data.rating);
            });
    }
    const validateForm = (formSelector, fieldsConfig) => {
        const formElement = document.querySelector(formSelector);
        if (!formElement) return;

        FormValidation.formValidation(formElement, {
            fields: fieldsConfig,
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: ".form-floating",
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                autoFocus: new FormValidation.plugins.AutoFocus(),
            },
            init: (instance) => {
                instance.on("plugins.message.placed", (e) => {
                    if (
                        e.element.parentElement.classList.contains(
                            "input-group"
                        )
                    ) {
                        e.element.parentElement.insertAdjacentElement(
                            "afterend",
                            e.messageElement
                        );
                    }
                });

                instance.on("core.element.validated", (e) => {
                    if (e.valid) {
                        e.element.classList.add("is-valid");
                    } else {
                        e.element.classList.remove("is-valid");
                    }
                });

                instance.on("core.form.valid", () => {
                    formElement.submit();
                });
            },
        });
    };

    validateForm("#reviewForm", {
        review: {
            validators: {
                notEmpty: {
                    message: "Please enter the review",
                },
                stringLength: {
                    min: 5,
                    message: "Review must be at least 5 characters long",
                },
            },
        },
        rating: {
            validators: {
                notEmpty: {
                    message: "Please enter the rating",
                },
                between: {
                    min: 1,
                    max: 5,
                    message: "Rating must be between 1 and 5",
                },
            },
        },
        elearning_id: {
            validators: {
                notEmpty: {
                    message: "Please select an e-learning",
                },
            },
        },
    });
});
