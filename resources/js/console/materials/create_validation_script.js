document.addEventListener("DOMContentLoaded", () => {
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

    validateForm("#materialForm", {
        title: {
            validators: {
                notEmpty: {
                    message: "Please enter the video title",
                },
                stringLength: {
                    min: 2,
                    message: "Title must be at least 2 characters long",
                },
            },
        },
        description: {
            validators: {
                notEmpty: {
                    message: "Please enter the description",
                },
                stringLength: {
                    min: 5,
                    message: "Description must be at least 5 characters long",
                },
            },
        },
        thumbnail: {
            validators: {
                notEmpty: {
                    message: "Please upload a thumbnail image",
                },
                file: {
                    extension: "jpg,jpeg,png",
                    type: "image/jpeg,image/png",
                    message:
                        "Please choose a valid image file (jpg, jpeg, png)",
                },
            },
        },
        video: {
            validators: {
                notEmpty: {
                    message: "Please enter the video URL",
                },
                uri: {
                    message: "Please enter a valid URL",
                },
            },
        },
    });
});
