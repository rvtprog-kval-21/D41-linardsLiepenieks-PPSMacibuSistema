<template>

    <div>

        <div class="box-header with-border row align-items-center justify-content-between">
            <div class="col-9"><h3 class="box-title">Pievienot paraugdatus</h3>
            </div>
            <div @click="addTest">
                <button type="button" class="btn btn-default bg-green"><i
                    class="far fa-plus-square"></i></button>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Stdin</th>
                    <th>Stdout</th>
                    <th style="width: 10px; "><i class="fas fa-eye"></i></th>
                </tr>


                <tr v-for="(input, index) in inputs" class="form-group">

                    <th style="width: 10px" v-model="input.id">{{input.id+1}}
                        <div @click="removeTest(index)">
                            <button type="button" class="btn btn-danger bg-red"><i
                                class="far fa-minus-square"></i></button>
                        </div>
                    </th>

                    <th><textarea class="w-100 form-control" v-bind:id="'input'[input.id]" v-bind:name="'tests[stdin]['+index+']'"
                                  style="width: 100%; height: 100%; box-sizing: border-box;">ievaddati {{input.id}}</textarea>
                    </th>
                    <th><textarea class="w-100 form-control" v-bind:id="'output'+input.id"
                                  v-bind:name="'tests[stdout]['+index+']'"
                                  style="width: 100%; height: 100%; box-sizing: border-box;">ievaddati</textarea></th>
                    <th style="width: 10px; "><input type="checkbox" class="form-control" v-bind:id="'see'+input.id"
                                                     v-bind:name="'tests[show]['+index+']'"></th>


                </tr>


            </table>
        </div>

    </div>

</template>

<script>
    export default {
        mounted() {
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
                var test = "TESTS";
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: onsubmit,
                    type: "post",
                    data: {test: 1},
                    //dataType: 'text JSON',
                    success: function (response) {
                        if (response)
                            alert('Success!!!!:' + response);
                    },
                    error: function (response) {
                        alert('Errormessage:' + response);
                    }
                });


            },
        }
    }
</script>
