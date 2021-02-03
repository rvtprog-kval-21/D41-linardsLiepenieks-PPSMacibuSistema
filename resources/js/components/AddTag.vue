<template>
    <div>
        <!-- Header -->
        <div class="box-header with-border row align-items-center justify-content-between">

            <!-- Title -->
            <div class="col-9">
                <h3 class="box-title">Pievienot paraugdatus</h3>
            </div>

            <!-- Addtest button-->
            <div @click="addTest">
                <button type="button" class="btn btn-default bg-green">
                    <i class="far fa-plus-square"></i>
                </button>
            </div>
        </div>

        <div class="row">
            <table class="table table-bordered">
                <!-- Info tags -->
                <tr>
                    <th style="width: 7%" class="text-center">#</th>
                    <th style="width: 40%">Nosaukums</th>
                    <th style="width: 40%">Apraksts</th>
                    <th style="width: 13%">Krāsa</th>
                </tr>

                <!-- Dynamically added tags -->
                <tr v-for="(input, index) in inputs" class="form-group text-center"
                    v-bind:id="'inputRow'+ index">

                    <!-- Tag id/ remove button -->
                    <th style="width: 10px" class="text-center" v-model="input.id">
                        {{ input.id + 1 }}
                        <!-- Remove tag button -->
                        <div @click="removeTest(index)">
                            <button type="button" class="btn btn-danger bg-red"><i
                                class="far fa-minus-square"></i></button>
                        </div>
                    </th>

                    <!-- Nosaukums input -->
                    <th>
                        <textarea class="w-100 form-control"
                                  v-bind:id="'Nosaukums'+index"
                                  v-bind:name="'newTags[name]['+index+']'"
                                  style="width: 100%; height: 100%; box-sizing: border-box;">
                        </textarea>

                    </th>
                    <!-- Apraksts input -->
                    <th>
                        <textarea class="w-100 form-control"
                                  v-bind:id="'Apraksts'+index"
                                  v-bind:name="'newTags[desc]['+index+']'"
                                  style="width: 100%; height: 100%; box-sizing: border-box;">
                        </textarea>

                    </th>
                    <th class="align-middle">
                        <input type="color"
                                v-bind:id = "'Color'+index"
                               v-bind:name="'newTags[color]['+index+']'"
                               @input="changeColor(index)">
                    </th>


                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {

    props:['oldTags'],
    beforeMount(){
        for(let i = 0;i<this.oldTags.length;i++)
        {
            this.inputs.push({
                id: this.inputs.length,
                type: "new"
            });
        }
    },
    mounted() {

        console.log(this.oldTags);
        for(let i = 0;i<this.oldTags.length;i++)
        {
            document.getElementById("Nosaukums"+i).value = this.oldTags[i]['name'];
            document.getElementById("Apraksts"+i).value = this.oldTags[i]['desc'];
            document.getElementById("Color"+i).value = this.oldTags[i]['color'];
            document.getElementById("inputRow"+i).style.background = this.oldTags[i]['color'];
        }


    },


    data() {
        return {
            inputs: []
        };
    },

    methods: {


        addTest() {

            this.inputs.push({

                id: this.inputs.length,
                type: "new"
            });
            //document.getElementById("Color"+this.inputs.length-1).value = "#F4F6F9";


        },
        removeTest(index) {

            this.inputs.splice(index, 1);

            var i = 0;
            for (i; i < this.inputs.length; i++) {
                this.inputs[i].id = i;
            }


        },

        changeColor(index){
            document.getElementById('inputRow' + index).style.backgroundColor = document.getElementById('Color' + index).value;;
        },
    }
}
</script>
