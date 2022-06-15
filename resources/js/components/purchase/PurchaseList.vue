<template>
    <div class="container">
        
            <br>
            <h1 class="display-4">Purchase List</h1>
            <hr>
            <div>
                <b-table :items="items" :fields="fields">
                <template #cell(show_details)="row" class="">
             
                    <b-form-checkbox v-model="row.detailsShowing" @change="row.toggleDetails">
                   
                    </b-form-checkbox>
                </template>

                <template #row-details="row">
                    <b-card>
                         
                    <b-row>
                        <b-col >
                            <b-avatar size="90px">Hello<br>World</b-avatar>
            
                        </b-col>

                        <!------------------------------------------>

                        <b-col class="text-sm-right">
                            <ul v-for="tem in row.item.detailedPurchase" :key="tem.Date">
                                <li>{{tem.Date}} - </li>
                                <li>&#8369;  {{tem.Amount}}</li>
                            </ul>
                            <ul>
                                <li>Total - </li>
                                <li>&#8369;  <b>{{ row.item.Amount }}</b></li>
                            </ul>
                        </b-col>

                    </b-row>
                    </b-card>
                </template>
                </b-table>
            </div>
            <b-btn  @click="submit()">click</b-btn>


    </div>
</template>
<script>

export default {
   
    data() {
        return {
            fields: ['Purchase_No','name', 'Amount','Date', 'Show_details'],
            fields2: ['Date', 'Amount'],
        items: [
          { isActive: true, Purchase_No: '0998979fbfgn', name: 'Joe', Amount: 480.00,  Date:'jandfbvdfuary 10, 2021',
          detailedPurchase: [
              { Date:'Jan. 12, 2021', Amount: 250.00 }, 
              { Date:'Jan. 10, 2021', Amount: 230.00 },
            ]
        },
          { isActive: false, Purchase_No: '09989798dfd', name: 'Bars', Amount: 500.00 , Date:'janddduary 10, 2021',
          detailedPurchase: [
              { Date:'Jan. 12, 2021', Amount: 200.00 }, 
              { Date:'Jan. 10, 2021', Amount: 300.00 },
            ]
        },
          { isActive: false, Purchase_No: '0998979dfd8', name: 'Romy', Amount: 200.00, Date:'janudddary 10, 2021',
          detailedPurchase: [
              { Date:'Jan. 12, 2021', Amount: 100.00 }, 
              { Date:'Jan. 10, 2021', Amount: 100.00 },
            ]
        },
          { isActive: true, Purchase_No: '0998dfdf9798', name: 'Jun', Amount: 350.00, Date:'janugggary 10, 2021',
          detailedPurchase: [
              { Date:'Jan. 12, 2021', Amount: 150.00 }, 
              { Date:'Jan. 10, 2021', Amount: 200.00 },
            ]
        }]

        }
        
    },
    methods:{
        
    }
}
</script>
<style scoped>
ul li{
    display:inline-block;
}

</style>