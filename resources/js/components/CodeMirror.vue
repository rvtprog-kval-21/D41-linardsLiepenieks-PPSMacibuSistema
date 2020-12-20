<template>
    <div>

            <select class="m-3" id="mode" name="mode">
                <option>C++</option>
                <option>Python</option>
                <option>Javascript</option>
                <option>JAVA</option>
                <option>CSS</option>
            </select>
            <div style="border: 1px solid black; width:100%;">
                <textarea id="editor" name="code"></textarea></div>

    </div>
</template>

<script>
    export default {
        mounted() {

            let code = document.createElement('script');
            code.setAttribute('src', '/js/codemirror.js');
            document.body.appendChild(code);
            code.onload = () => {


                let stripeScript = document.createElement('script');
                stripeScript.setAttribute('src', '/js/codemirrorModes/javascript.js');
                stripeScript.onload = () => {

                    var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
                        lineNumbers: true,
                        matchBrackets: true,
                        continueComments: "Enter",
                        extraKeys: {"Ctrl-Q": "toggleComment"}
                    });
                    console.log("CodeMirror loaded");
                };

                document.body.appendChild(stripeScript);
            };

        }
    }
</script>
