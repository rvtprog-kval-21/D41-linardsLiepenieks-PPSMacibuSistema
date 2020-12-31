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
        },
        mode: {
            default: "C++"
        },
        modeId: {
            default: "mode"
        },
        timestamp: {
            default: "---"
        },
        disabled: {
            default: false

        }
    },

    mounted() {


        this.enableCodemirror();


    },

    methods: {
        enableCodemirror() {

            document.getElementById("editor").id = this.textAreaId;
            document.getElementById("mode").id = this.modeId;

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
            this.disableCM(this.disabled);

            this.onChange(this.mode);
        },
        onChange(mode = document.getElementById(this.modeId).value) {

            let setMode = "";
            switch (mode) {
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
            }
            document.getElementById(this.modeId).value = mode;
            this.editor.setOption("mode", setMode);
        },
        disableCM(x){

            if(x=="true")
            {
                this.editor.setOption("readOnly", true);
                console.log(this.editor.getOption("readOnly"));

                document.getElementById(this.modeId).disabled = true;
            }
        }

}
}
</script>
