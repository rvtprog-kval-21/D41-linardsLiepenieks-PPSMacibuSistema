<template>
    <div>

            <select class="m-3" id="mode" name="mode" @change="onChange()">
                <option>C++</option>
                <option>Python</option>
                <option>Javascript</option>
                <option>JAVA</option>
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


                let clike = document.createElement('script');
                clike.setAttribute('src', '/js/codemirrorModes/clike.js');
                clike.onload = () => {

                      this.editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
                        lineNumbers: true,
                        matchBrackets: true,
                        continueComments: "Enter",
                        mode: "text/x-c++src",
                        extraKeys: {"Ctrl-Q": "toggleComment"}
                    });


                };

                document.body.appendChild(clike);
                let js = document.createElement('script');
                js.setAttribute('src', '/js/codemirrorModes/javascript.js');
                document.body.appendChild(js);
                let py = document.createElement('script');
                py.setAttribute('src', '/js/codemirrorModes/python.js');
                document.body.appendChild(py);
            };



        },

        methods: {
            onChange() {
                var setMode = "";
                switch(document.getElementById("mode").value) {
                    case "C++":
                        setMode = "text/x-c++src";
                        break;
                    case "JAVA":
                        setMode = "text/x-java";
                        break;
                    case "Python":
                        setMode = "python";
                        break;
                    case "Javascript":
                        setMode = "javascript";
                        break;
                    default:
                        setMode = "C++";
                    // code block
                }

                this.editor.setOption("mode", setMode);
            }
        }
    }
</script>
