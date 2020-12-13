<template>

    <div>
        <div class="box-header with-border row align-items-center justify-content-between">
            <div class="col-9"><h3 class="box-title">Pievienot paraugdatus WIP</h3>
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




      <tr v-for="(input, index) in inputs" style="">

                    <th style="width: 10px" v-model="input.id">{{input.id}}
                        <div @click="removeTest(index)">
                            <button type="button" class="btn btn-danger bg-red"><i
                                class="far fa-minus-square"></i></button>
                        </div>
                    </th>
                    <th><textarea class="w-100" style="width: 100%; height: 100%; box-sizing: border-box;">ievaddati {{input.id}}</textarea></th>
                    <th><textarea class="w-100" style="width: 100%; height: 100%; box-sizing: border-box;">ievaddati</textarea></th>
                    <th style="width: 10px; "><input type="checkbox"></th>


                </tr>


            </table>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },


        data() {
            return {
                next: 1,
                inputs: []
            };
        },

        methods: {
            addTest() {
                this.inputs.push({
                    id: this.next
                });

                this.next = this.next + 1
            },
            removeTest(index) {

                this.inputs.splice(index, 1);

                var i = 1;
                this.next = this.next-1;
                for(i;i<this.next;i++)
                {
                    this.inputs[i+1].id = this.inputs[i].id+parseInt(1);
                }



            }
        }
    }
</script>
