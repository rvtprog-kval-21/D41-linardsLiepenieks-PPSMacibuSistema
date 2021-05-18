<template>
    <div>


        <div class="input-group rounded">

            <select class="m-0 form-select PPS-info-button"
                    v-model="filter"
            @change="changeFilter(filter)">
                <option disabled value="0">Filtrs</option>

                <option value="1">Bez filtra</option>
                <option value="2">Pievienošanas laiks</option>
                <option value="3">Grūtība</option>
                <option value="4">Atrisinājumu reitings</option>
            </select>

            <select class="PPS-info-button m-0"
            v-model="way"
            @change="changeWay(filter, way)">
                <option disabled value="0">Secība</option>
                <option value="1">Augošā</option>
                <option value="2">Dilstošā</option>
            </select>

            <input type="search" class="form-control rounded" placeholder="Meklēt" aria-label="Search"
                   id="searchBar"
                   aria-describedby="search-addon"
                   v-model="message"
                   @input="searchBarChange(message)"/>
            <span class="input-group-text border-0" id="search-addon">
    <i class="fas fa-search"></i>
        </span>
        </div>


        <div class="row PPS-content-header text-center align-items-center p-2 rounded"
             style="margin: 10px 0px 10px 0px;">
            <div class="col">Uzdevuma kods</div>
            <div class="col">Nosaukums</div>
            <div class="col">Veiksmīgi atrisinājumi</div>
            <div class="col">Iesūtījumi</div>
            <div class="col">Atrisinājumi</div>
            <div class="col">Tagi</div>
        </div>

        <div v-for="(exercise) in searchExercises">
            <a :href="'/exercises/show/'+exercise.id">

                <div class="m-0 mb-2 p-2 row PPS-content-wrapper PPS-exercise text-center align-items-center rounded"
                     style="font-size: 1.5rem;
                            color: black;">

                    <div class="col">{{ exercise.kods }}</div>
                    <div class="col">
                        {{ exercise.nosaukums }}
                    </div>
                    <div class="col row align-items-center">
                        <div class="col-9 p-0">
                            <div class="progress" style="border: 1px solid black">
                                <div class="progress-bar"
                                     aria-valuemin="0"
                                     aria-valuemax="100"
                                     :style="'width: '+

                            parseInt(findInArr(submissions, exercise.id) > 0 && findInArr(solutions, exercise.id) > 0 ? findInArr(solutions, exercise.id) / findInArr(submissions, exercise.id) * 100 : 0)

                                +'%;'"
                                >
                                </div>
                            </div>
                        </div>

                        <div class="col-2 p-1">
                            {{
                                findInArr(submissions, exercise.id) > 0 && findInArr(solutions, exercise.id) > 0 ?
                                    findInArr(solutions, exercise.id) / findInArr(submissions, exercise.id) * 100 : 0
                            }}%
                        </div>
                    </div>

                    <div
                        class="col">{{ findInArr(submissions, exercise.id) }}
                    </div>
                    <div class="col">{{ findInArr(solutions, exercise.id) }}</div>

                    <div class="col">

                    <span v-for="(tag) in getTags(exercise.id)" class="badge"
                          :style="'background:'+ tag.color+'; color: black'">
                    {{ tag.name }}
                    </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
export default {

    props: ['exercises', 'solutions', 'submissions', 'exercise_tags', 'tags'],

    mounted() {
        this.searchExercises = this.exercises;
    },

    data() {
        return {
            searchExercises: 0,
            message: '',
            key: "",
            filter: 0,
            way: 1,
        };
    },

    methods: {

        findInArr(arr, find) {
            let count = 0;
            arr.forEach(
                function (el) {
                    if (el.exercise_id == find) {
                        count++;
                    }
                }
            )
            return count;
        },

        getTags(exercise) {
            let inTags = this.tags;
            let getTags =
                this.exercise_tags.filter(
                    function (e) {
                        return e.exercise_id == exercise
                    }
                );


            let outTags = [];
            getTags.forEach(
                function (el) {
                    outTags.push(inTags.find(
                        e => e.id == el.tag_id
                    ))
                }
            );
            return outTags;

        },

        searchBarChange(input) {
            if (input == '') {
                this.searchExercises = this.exercises;
                return
            }
            this.searchExercises = this.exercises.filter(
                item => item.nosaukums.toLowerCase().indexOf(input) > -1);

        },

        changeFilter(e)
        {
          if(e==1)
          {
              this.searchExercises = [];
              this.searchExercises = this.exercises;
          }
          else if(e==2)
          {
              this.searchExercises.sort((prev, curr) => Date.parse(curr.created_at) - Date.parse(prev.created_at)
              )

          }
          else if(e==3)
          {
              this.searchExercises.sort((prev, curr) => curr.difficulty - prev.difficulty)
              console.log(this.searchExercises);

          }
          else if(e==4)
          {
              this.searchExercises.sort((prev, curr) => (this.findInArr(this.solutions, prev.id) / this.findInArr(this.submissions, prev.id) * 100) -
                  (this.findInArr(this.solutions, curr.id) / this.findInArr(this.submissions, curr.id) * 100))
              console.log(this.searchExercises);

          }
        },
        changeWay(filter, way)
        {
            $(this).attr('disabled', true).siblings().removeAttr('disabled');

            if(filter!=0&&filter!=1)
            {
                this.searchExercises.reverse();
            }
            else
            {
                this.way = 1;
            }


        }

    },
}
</script>
