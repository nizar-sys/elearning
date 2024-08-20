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

    validateForm("#articleForm", {
        category_id: {
            validators: {
                notEmpty: {
                    message: "Please select a category",
                },
            },
        },
        created_by: {
            validators: {
                notEmpty: {
                    message: "Please select a creator",
                },
            },
        },
        title: {
            validators: {
                notEmpty: {
                    message: "Please enter the article title",
                },
                stringLength: {
                    min: 2,
                    message: "Title must be at least 2 characters long",
                },
            },
        },
        content: {
            validators: {
                notEmpty: {
                    message: "Please enter the content",
                },
                stringLength: {
                    min: 5,
                    message: "Content must be at least 5 characters long",
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
        status: {
            validators: {
                notEmpty: {
                    message: "Please select a status",
                },
            },
        },
    });
});
