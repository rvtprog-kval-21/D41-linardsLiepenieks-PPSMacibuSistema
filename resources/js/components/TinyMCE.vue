<template>
    <!DOCTYPE html>
    <div>


    </div>
</template>

<script>

import tinymce from "../../../public/vendor/tinymce";

export default {

    mounted() {

        tinymce.init({
            selector : "textarea",
            elements: "editor",
            theme : "silver"
        })

    },

    methods: {

    }
}
</script>
