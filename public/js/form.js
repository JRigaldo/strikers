jQuery(function ($) {
    $(document).ready(function () {
        function materialDesign() {
            // For personnal form
            var fieldInpout = $(".field-input")
            fieldInpout.focus(function () {
                $(this).parent().addClass("is-focused has-label")
            })
            fieldInpout.each(function () {
                if ($(this).val() !== "") {
                    $(this).parent().addClass("has-label")
                }
            })
            fieldInpout.blur(function () {
                if ($(this).val() === "") {
                    $(this).parent().removeClass("has-label")
                }
                $(this).parent().removeClass("is-focused")
            })
            $(".field-textarea").focus(function () {
                $(this).parent().addClass("is-focused has-label")
            })
            $(".field-textarea").blur(function () {
                if ($(this).val() === "") {
                    $(this).parent().removeClass("has-label")
                }
                $(this).parent().removeClass("is-focused")
            })
            var fieldInlineInput = $(".field-inline-input")
            fieldInlineInput.focus(function () {
                $(this).parent().addClass("is-focused has-label")
            })
            fieldInlineInput.each(function () {
                if ($(this).val() !== "") {
                    $(this).parent().addClass("has-label")
                }
            })
            fieldInlineInput.blur(function () {
                if ($(this).val() === "") {
                    $(this).parent().removeClass("has-label")
                }
                $(this).parent().removeClass("is-focused")
            })
        }
        materialDesign()

        function selectList() {
            var selected = $(".selected")
            var optionsContainer = $(".options-container")
            var optionList = $(".option")

            selected.each(function () {
                $(this).click(function () {
                    optionsContainer.toggleClass("active")
                    $(this).addClass("is-focused")
                })
            })

            optionList.each(function () {
                $(this).click(function (e) {
                    e.preventDefault()
                    selected.find("span").html($(this).find("label").text())
                    selected.removeClass("is-focused")
                    optionsContainer.removeClass("active")
                })
            })

            $(document).mouseup(function (e) {
                e.preventDefault()
                if (!optionsContainer.is(e.target) || optionsContainer.has(e.target).length === 0) {
                    selected.removeClass("is-focused")
                    optionsContainer.removeClass("active")
                }
            })
        }

        function selectFlaf() {
            var selected = $(".selected-icon")
            var optionsContainer = $(".options-container-icons")
            var optionList = $(".option-icon")

            selected.each(function () {
                $(this).click(function () {
                    optionsContainer.toggleClass("active")
                    $(this).addClass("is-focused")
                })
            })

            optionList.each(function () {
                $(this).click(function (e) {
                    e.preventDefault()
                    selected.find("svg").html($(this).find("svg").html())
                    selected.removeClass("is-focused")
                    optionsContainer.removeClass("active")
                })
            })

            $(document).mouseup(function (e) {
                e.preventDefault()
                if (!optionsContainer.is(e.target) || optionsContainer.has(e.target).length === 0) {
                    selected.removeClass("is-focused")
                    optionsContainer.removeClass("active")
                }
            })
        }

        selectList()
        selectFlaf()
    })
})
