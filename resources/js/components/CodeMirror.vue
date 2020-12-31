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
    props: {
        textAreaId: {
            default: "editor"
        },
        code: {
            default: ""
        }
    },
    mounted() {

        let code = document.createElement('script');
        code.setAttribute('src', '/js/codemirror.js');
        document.body.appendChild(code);
        code.onload = () => {

            let refresh = document.createElement('script');
            refresh.setAttribute('src', '/js/autorefresh.js');
            document.body.appendChild(refresh);
            refresh.onload = () => {

                let clike = document.createElement('script');
                clike.setAttribute('src', '/js/codemirrorModes/clike.js');
                document.body.appendChild(clike);
                clike.onload = () => {
                    this.enableCodemirror();
                }

                let js = document.createElement('script');
                js.setAttribute('src', '/js/codemirrorModes/javascript.js');
                document.body.appendChild(js);

                let py = document.createElement('script');
                py.setAttribute('src', '/js/codemirrorModes/python.js');
                document.body.appendChild(py);
            }

        };



    },

    methods: {
        enableCodemirror() {
                console.log(this.code);
                document.getElementById("editor").id = this.textAreaId;

                document.getElementById(this.textAreaId).innerHTML = this.code;
                let codemirror = document.getElementById(this.textAreaId);
                codemirror = CodeMirror.fromTextArea(document.getElementById(this.textAreaId), {
                    lineNumbers: true,
                    autoRefresh: true,
                    matchBrackets: true,
                    continueComments: "Enter",
                    mode: "text/x-c++src",
                    extraKeys: {"Ctrl-Q": "toggleComment"}
                });
                //codemirror.setValue(this.code);
                this.editor = codemirror;
        },
        onChange() {
            let setMode = "";
            switch (document.getElementById("mode").value) {
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
