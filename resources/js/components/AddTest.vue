<template>
    <div class="m-3">
        <!-- Header -->
        <div class="box-header with-border row align-items-center justify-content-between">

            <!-- Title -->
            <div class="col-9 PPS-page-title">
                <h3 class="box-title">Pievienot paraugdatus</h3>
            </div>

            <!-- Addtest button-->
            <div @click="addTest">
                <button type="button" class="btn PPS-add-button">
                    <i class="far fa-plus-square"></i>
                </button>
            </div>
        </div>

        <div class="row PPS-content-header">
            <table class="table table-bordered ">
                <!-- Info tags -->
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Stdin</th>
                    <th>Stdout</th>
                    <th style="width: 10px; "><i class="fas fa-eye"></i></th>
                </tr>

                <!-- Dynamically added tests -->
                <tr v-for="(input, index) in inputs" class="form-group PPS-content-wrapper">

                    <!-- Test case id/ remove button -->
                    <th class="text-center" style="width: 10px" v-model="input.id">
                        {{ index + 1 }}
                        <!-- Remove test button -->
                        <div @click="removeTest(index)">
                            <button type="button" class="btn PPS-delete-button"><i
                                class="far fa-minus-square"></i></button>
                        </div>
                    </th>

                    <!-- Stdin input -->
                    <th>
                        <textarea class="w-100 form-control"
                                  v-bind:id="'input'[input.id]"
                                  v-bind:name="'tests[stdin]['+index+']'"
                                  v-model="input.stdin"
                                  style="width: 100%; height: 100%; box-sizing: border-box;">
                        </textarea>

                    </th>

                    <!-- stdout input -->
                    <th>
                        <textarea class="w-100 form-control"
                                  v-bind:id="'output'+input.id"
                                  v-bind:name="'tests[stdout]['+index+']'"
                                  v-model="input.stdout"
                                  style="width: 100%; height: 100%; box-sizing: border-box;">
                        </textarea>
                    </th>

                    <!-- isVisible checkbox -->
                    <th style="width: 10px; ">
                        <input type="checkbox"
                               class="form-control"
                               v-bind:id="'see'+input.id"
                               v-bind:name="'tests[show]['+index+']'"
                               true-value="1"
                               false-value="0"
                               v-model="input.show">
                    </th>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: ['oldTests'],

    mounted() {
        this.$root.$on('send-test', data => {
            this.inputs.push({
                stdin: data.stdin,
                stdout: data.stdout,
                show: data.show
            })

        })

        if (this.oldTests != null) {

            this.oldTests.forEach(
                element => this.inputs.push({
                    type: "old",
                    stdin: element.stdin,
                    stdout: element.stdout,
                    show: element.show
                }))
        }

        //this.inputs = this.inputs.splice(20);


    },


    data() {
        return {
            inputs: []
        };
    },

    methods: {
        addTest() {
            this.inputs.push({
                id: this.inputs.length
            });


        },
        removeTest(index) {

            this.inputs.splice(index, 1);

            var i = 0;
            for (i; i < this.inputs.length; i++) {
                this.inputs[i].id = i;
            }


        },

        submitExercise() {
            var tests = [];
            var i = 0;
            for (i; i < this.inputs.length; i++) {
                tests.push(document.getElementById('input' + i).value,
                    document.getElementById('output' + i).value,
                    document.getElementById('see' + i).checked);

            }


        },
    }
}
</script>
