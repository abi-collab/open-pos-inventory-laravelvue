<template>
  <section class="content">
    <div class="container noPrint">
      <b-row>
        <b-col style="display: flex">
          <b style="margin: auto; padding-right: 10px">Customer:</b>
          <b-input-group>
            <b-form-select
              v-model="selected"
              :options="customerx"
              value-field="data"
              text-field="name"
            ></b-form-select>

            <template #append>
              <b-btn variant="outline-secondary" v-b-modal.cusModal>
                <b-icon icon="plus"></b-icon> Add New</b-btn
              >
            </template>
          </b-input-group>

          <div>
            <b-modal
              id="cusModal"
              title="Enter Customer Information"
              hide-footer
              no-close-on-backdrop
            >
              <form @submit.prevent="createCustomer()">
                <div>
                  <b-form-group>
                    <label>Name</label>
                    <b-form-input
                      v-model="form.name"
                      type="text"
                      name="name"
                    ></b-form-input>
                  </b-form-group>
                  <b-form-group>
                    <label>Conatct No.</label>
                    <b-form-input
                      v-model="form.contactNo"
                      type="number"
                      name="contactNo"
                    ></b-form-input>
                  </b-form-group>
                  <b-form-group>
                    <label>Address</label>
                    <b-form-input
                      v-model="form.address"
                      type="text"
                      name="address"
                    ></b-form-input>
                  </b-form-group>
                </div>
                <br />
                <hr />
                <div style="text-align: right">
                  <b-btn
                    type="button"
                    variant="outline-secondary"
                    @click="clearAddCus()"
                    >Clear All</b-btn
                  >
                  <b-btn
                    type="submit"
                    variant="outline-success"
                    @click="$bvModal.hide('cusModal')"
                    >Create Customer</b-btn
                  >
                </div>
              </form>
            </b-modal>
          </div>
        </b-col>
      </b-row>

      <b-row>
        <b-col cols="3">
          <div class="mt-3" style="display: flex">
            <b style="padding-right: 10px">Contact No: </b
            >{{ selected.contactNo }}
          </div>
        </b-col>
        <b-col>
          <div class="mt-3" style="display: flex">
            <b style="padding-right: 10px">Address: </b>{{ selected.address }}
          </div>
        </b-col>
        <b-col cols="2">
          <div class="mt-3 text-right pull-right">
            <b-btn variant="outline-danger" @click="clearSelectCus()"
              >Clear</b-btn
            >
          </div>
        </b-col>
      </b-row>

       <!-- <b-form-input list="my-list-id" v-model="optVal"></b-form-input>
       {{optVal}}
        <datalist id="my-list-id">
            <option v-for="(size, index) in customerx" :key="index" :value="size.name">{{size.data.address}}</option>
        </datalist> -->
       
      <div>
        <br />
        <br />
        <b-input
          placeholder="enter serial number"
          v-model="serial"
          @keyup.enter="onEnter"
        ></b-input>
        <b-alert
          v-model="showyellow"
          class="m-0 rounded-0"
          style="z-index: 2000"
          :variant="vars(returnvalue.orderno)"
          v-if="serial !== ''"
        >
          <table class="table">
            <thead>
              <th><small>serial no</small></th>
              <th><small>name</small></th>
              <th><small>description</small></th>
              <th><small>price</small></th>
              <th><small>petsa</small></th>
              <th><small>orderno</small></th>
            </thead>
            <tbody>
              <tr>
                <td>
                  <small>{{ returnvalue.serialnumber }}</small>
                </td>
                <td>
                  <small>{{ returnvalue.name }}</small>
                </td>
                <td>
                  <small>{{ returnvalue.description }}</small>
                </td>
                <td>
                  <small>&#8369;&nbsp;{{ returnvalue.price }}.00</small>
                </td>
                <td>
                  <small>{{ returnvalue.petsa }}</small>
                </td>
                <td>
                  <small>{{ returnvalue.orderno }}</small>
                </td>
              </tr>
            </tbody>
          </table>
        </b-alert>

       
        <table class="table">
          <thead>
            <th>serialNo</th>
            <th>Item&nbsp;#</th>
            <th>name</th>
            <th>description</th>
            <th>price</th>
            <th>Quantity</th>
            <th>X</th>
          </thead>
          <tbody>
            <tr v-for="(j, index) in cartx2" :key="index">
              <td>
                <ul v-for="(i, index) in j.serialnumber" :key="index">
                  <li>{{ i }}</li>
                </ul>
              </td>
              <td>{{ j.ssku }}</td>
              <td>{{ j.name }}</td>
              <td>{{ j.description }}</td>
              <td>&#8369;&nbsp;{{ j.price.toLocaleString() }}.00</td>
              <td>{{ j.quantity }}</td>
              <td>
                <b-btn @click="decreaseQuantity2(j, index)">-</b-btn>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="text-right pull-right">
          <b-btn @click="outx()" variant="outline-success">Check Out</b-btn>
        </div>
      </div>
    </div>

    <div style="height: 300px"></div>

    <!-- <b-btn @click="clearAllField()">clear</b-btn> -->
    <!-- <b-card>
      <div class="container noPrint">
        <h1>Reference Only</h1>
        Products with registered Serial numbers
        <table class="table">
          <thead>
            <th>id</th>
            <th>ssku</th>
            <th>serialno</th>
            <th>orderno</th>
            <th>order Date</th>
            <th>stocks</th>
            <th>imageId</th>
          </thead>
          <tbody>
            <tr v-for="(i, index) in productsWithSerialNos2" :key="index">
              <td>{{ i.id }}</td>
              <td>{{ i.ssku }}</td>
              <td>{{ i.serialnumber }}</td>
              <td>{{ i.orderno }}</td>
              <td>{{ i.orderdate | orderdates(i.orderdate) }}</td>
              <td>{{ i.stocks }}</td>
              <td>{{ i.imageid }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </b-card> -->

    <div id="spacelang" style="height: 2000px"></div><!---- just a distance for printing the invoice------>

    <div id="printMe">
      <b-row>
        <b-col>
          <br />
          <br />
          <h5>{{ ordernum }}</h5>
          <div>{{ new Date().toLocaleString() }}</div>
          <h4 style="margin: auto 0px 0px 0px">
            <b>LARAVEL-VUE</b> POS & INVENTORY SYSTEM
          </h4>

          Address line 1,<br />
          Address line 2 <br />
          Contact numbers
        </b-col>
        <b-col class="text-right pull-right">
          <h1>Business logo here</h1>
        </b-col>
      </b-row>

      <div><h5>Bill To</h5></div>
      <hr />
      <div>{{ selected.name }}</div>
      <div>{{ selected.address }}</div>
      <div>{{ selected.contactNo }}</div>
      <br />

      <br />

      <table class="table">
        <thead>
          <th>serialNo</th>
          <th>sku</th>
          <th>name</th>
          <th>description</th>
          <th>Quantity</th>
          <th>Price</th>
        </thead>
        <tbody>
          <tr v-for="(j, index) in cartx2" :key="index">
            <td>
              <ul v-for="(i, index) in j.serialnumber" :key="index">
                <li>{{ i }}</li>
              </ul>
            </td>
            <td>{{ j.ssku }}</td>
            <td>{{ j.name }}</td>
            <td>{{ j.description }}</td>
            <td>{{ j.quantity }}</td>
            <td>&#8369;&nbsp;{{ j.price.toLocaleString() }}.00</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td class="text-right" colspan="2">
              <strong>Grand Total</strong>
            </td>
            <td class="text-right pull-right">{{ cartTotal | currency }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>

<script>
import VueTagsInput from "@johmun/vue-tags-input";
import html2canvas from "html2canvas";

import moment from "moment";

export default {
  components: {
    VueTagsInput,
  },
  data() {
    return {
      currentUser: {},
      searchProduct: "",
      orderedProduct_id: [],
      selected: {},
      customerx: null,
      groupWrapper: "list-group-item",
      isShowingCart: false,
      cart: {
        items: [],
      },
      products: {
        data: [],
        message: "",
      },

      form: new Form({
        id: "",
        name: "",
        contactNo: "",
        address: "",
      }),
      output: null,
      image: { backgroundImage: "url(https://via.placeholder.com/150)" },

      categories: [],
      purId: null,
      ProductsWithSerialNos: [],

      productsWithSerialNos2: [],

      serial: "",
      cartx2: [],
      showyellow: true,
      ordernum: "",
      ssImg: "",
      optVal:''
    };
  },

  methods: {
   
    outx() {
      if (this.selected.id == null) {
        Swal.fire({
          icon: "warning",
          title: "Please Choose a Customer",
          showConfirmButton: true,
        });
      } else if (this.cartx2.length < 1) {
        Swal.fire({
          icon: "warning",
          title: "Your Purchase Order List is empty",
          showConfirmButton: true,
        });
      } else if (this.selected.id != null && this.cartx2.length >= 1) {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
        }).then((result) => {
          if (result.isConfirmed) {
            let d = new Date();
            let year = d.getFullYear();
            let month = d.getMonth() + 1;
            let day = d.getDate();
            let time = d.getTime();

            this.ordernum = "P" + month + "R" + year + "H" + day + "S" + time;

            let idforImage = year + "I" + month + "M" + day + "G" + time;

            window.scrollTo(0, 0);
            html2canvas(document.querySelector("#printMe"))
              .then((canvas) => {
                // document.body.appendChild(canvas);
                this.ssImg = canvas.toDataURL("image/png", 0.9);
                // console.log(canvas.toDataURL("image/png", 0.9));
              })
              .then(() => {
                //  const formData = new FormData;
                //   formData.set('image', this.ssImg);

                axios
                  .post("api/invoiceImgSave/", {
                    imageid: idforImage,
                    invoiceimg: this.ssImg,
                  })
                  .then((res) => {
                    console.log(res);
                  });
              });

            var mergedIds = [].concat.apply([], this.ids);

            for (let i = 0; i < mergedIds.length; i++) {
              axios
                .put("api/serialno/" + mergedIds[i], {
                  orderno: this.ordernum,
                  orderdate: d,
                  customerid: this.selected.id,
                  imageid: idforImage,
                })
                .then((res) => {
                  console.log(res);

                });
            }
            axios
              .put("api/updateProductQty/", this.leftx)
              .then((response) => {
                console.log("updates stocks left");
                console.log(response);
              })
              .then((res) => {
                console.log("update stock: " + res);
              
                this.print();
                this.productsWithSerialNo();
                this.checkout(this.ordernum);
                this.clearAllField();
              });
         
          }
        });
      } else {
        alert("something wrong");
      }
    },

    clearAllField() {
      this.cartx2 = [];
      this.selected = {};
    },
    async print() {
      // Pass the element id here
      // window.print();
      await this.$htmlToPaper("printMe");
      this.cart.items = [];
      this.clearSelectCus();
    },
    loadCategories() {
      axios
        .get("api/category")
        .then(({ data }) => (this.categories = data.data));
    },
    loadProducts() {
      // if(this.$gate.isAdmin()){
      axios
        .get("api/customersOrder")
        .then(({ data }) => (this.products.data = data.data.data));
      // }
    },

    // getResults(page = 1) {
    //     this.$Progress.start();
    //     axios.get('api/customers?page=' + page).then(({ data }) => (this.customers = data.data));
    //     this.$Progress.finish();
    // },
    loadCustomers2() {
      axios.get("api/customers").then(({ data }) => {
        let cus = [];

        for (let i = 0; i < data.length; i++) {
          // storing every objects original content to it's new declared object property(data)
          data[i].data = {
            name: data[i].name,
            id: data[i].id,
            address: data[i].address,
            contactNo: data[i].contactNo,
          };

          delete data[i].contactNo;
          delete data[i].address;
          delete data[i].id;

          cus.push(data[i]);
        }
        this.customerx = cus;
      });
    },
    loadGetProductsWithSerialNos() {
      axios
        .get("api/getProductsWithSerialNos")
        .then(({ data }) => (this.ProductsWithSerialNos = data));
    },
    productsWithSerialNo() {
      axios
        .get("api/productsWithSerialNo")
        .then(({ data }) => (this.productsWithSerialNos2 = data));
    },

    decreaseQuantity2(j, index) {
      j.quantity--;
        j.stocks++;

      if(j.serialnumber.length > 1) {
        j.serialnumber.pop();
        j.id.pop();
      }else if(j.quantity === 0) { 
        this.removeItemFromCart2(j);
      }
    },

    onEnter() {
   
      let a = this.productsWithSerialNos2;
      let b = [];
      let c = [];

      for (let j = 0; j < this.cartx2.length; j++) {
        c.push(...this.cartx2[j].serialnumber);
      }
      for (let i = 0; i < a.length; i++) {
        b.push(a[i].serialnumber);
      }
      if (b.includes(this.returnvalue.serialnumber)) {
        if (this.returnvalue === {}) {
          Toast.fire({
            icon: "error",
            title: "Oops!",
            text: "wala",
          });
        } else if (this.returnvalue.orderno != null) {
          Toast.fire({
            icon: "error",
            title: "Oops!",
            text:
              "Item with Serial No. " +
              this.serial +
              " is already been Purchased!",
          });
        } else if (c.includes(this.returnvalue.serialnumber)) {
          Toast.fire({
            icon: "error",
            title: "Oops!",
            text:
              "Item with Serial No. " + this.serial + " is already in Cart!",
          });
        } else {
          //add qty
          //for loop sa this.cartx2 to check if SKU already exist. if yes +Qty if no push this.return value

          var cartItem = this.getCartItem2(this.returnvalue);
          if (cartItem != null) {
            cartItem.quantity++;
            cartItem.stocks--;
            cartItem.id.push(this.returnvalue.id);
            cartItem.serialnumber.push(this.returnvalue.serialnumber);
          } else {
            this.cartx2.push({
              // product: this.returnvalue,
              // quantity: 1
              id: [this.returnvalue.id],
              name: this.returnvalue.name,
              description: this.returnvalue.description,
              category_id: this.returnvalue.category_id,
              stocks: this.returnvalue.stocks,
              price: this.returnvalue.price,
              sold: this.returnvalue.sold,
              stocks: this.returnvalue.stocks,
              criticalLevel: this.returnvalue.criticalLevel,
              ssku: this.returnvalue.ssku,
              serialnumber: [this.returnvalue.serialnumber],
              orderno: this.returnvalue.orderno,
              returnno: this.returnvalue.returnno,
              petsa: this.returnvalue.petsa,
              remarks: this.returnvalue.remarks,
              customerid: this.returnvalue.customerid,
              quantity: 1,
            });
          }
          this.returnvalue.stocks--;
          this.serial = "";
        }
      } else {
        Toast.fire({
          icon: "error",
          title: "Unknown Serial Number",
        });
      }
    },

    getCartItem2(returnvalue) {
      for (var i = 0; i < this.cartx2.length; i++) {
        if (this.cartx2[i].ssku === returnvalue.ssku) {
          return this.cartx2[i];
        }
      }
      return null;
    },

    createCustomer() {
      this.$Progress.start();
      console.log(this.form);

      this.form.post("api/customers").then((data) => {
        if (data) {
          $("#addNew").modal("hide");
          console.log(data);

          Toast.fire({
            icon: "success",
            title: "Customer Save Successfully!",
          });

          this.$Progress.finish();
          this.loadCustomers2();
        } else {
          Toast.fire({
            icon: "error",
            title: "Some error occured! Please try again....",
          });

          this.$Progress.failed();
        }
      });
      // .catch(()=>{

      //     Toast.fire({
      //         icon: 'error',
      //         title: 'Some error occured! Please try again'
      //     });
      // })
    },

    highlightProductsMatches(text) {
      const matchExists = text.toString().includes(this.searchProduct);
      if (!matchExists) return text;

      const re = new RegExp(this.searchProduct, "ig");
      return text
        .toString()
        .replace(re, (matchedText) => `<strong>${matchedText}</strong>`);
    },
    petsa() {
      const current = new Date();
      const date =
        current.getFullYear() +
        "k" +
        (current.getMonth() + 1) +
        "a" +
        current.getDate();
      const time =
        current.getHours() +
        "c" +
        current.getMinutes() +
        "c" +
        current.getSeconds();
      const dateTime = date.toString() + time.toString();

      return dateTime;
    },

    removeItemFromCart: function (cartItem) {
      var index = this.cart.items.indexOf(cartItem);

      if (index !== -1) {
        this.cart.items.splice(index, 1);
      }
    },
    removeItemFromCart2: function (j) {
      var index = this.cartx2.indexOf(j);

      if (index !== -1) {
        this.cartx2.splice(index, 1);
      }
      // console.log(index);
      // console.log(j);
    },

    stockLeft(b) {
      console.log("this b in stockleft()");
      console.log(b);
      const orderArray = b;

      orderArray.forEach((element) => {
        this.orderedProduct_id.push({
          id: element.id,
          qty: element.qty,
        });
      });

      axios
        .post("api/customerOrderProduct/", this.orderedProduct_id)
        .then((response) => {
          console.log("updates stocks left");
          console.log(response);
        });

      this.loadProducts();
    },

    checkout(ordernoThis) {
      this.cart.items.forEach(function (item) {
        item.product.stocks += item.quantity;
      });

      let a = this.cart.items;
      let b = [];

      for (let i = 0; i < a.length; i++) {
        a[i].product.qty = a[i].quantity;
        b.push(a[i].product);
      }

      let oras = this.petsa();

      let x = [];
      for (let f = 0; f < b.length; f++) {
        x.push({
          order_id: oras,
          sku: b[f].id,
          qty: b[f].qty,
        });
      }

      let d = new Date();
      let year = d.getFullYear();
      let month = d.getMonth() + 1;
      let day = d.getDate();
      let time = d.toTimeString();

      let date = year + "-" + month + "-" + day;

      axios
        .post("api/customersOrderx", {
          customer_ID: this.selected.id,
          amount_due: this.cartTotal,
          transaction_date: date,
          time: time,
          ID: ordernoThis,
          createdBy: this.currentUser.name,
          order_details: x,
        })
        .then(function (response) {
          console.log(response.data);
        })
        .catch(function (error) {
          console.log(error);
        });

      this.purId = oras;
    },

    addProductToCart(product) {
      var cartItem = this.getCartItem(product);

      if (cartItem != null) {
        cartItem.quantity++;
      } else {
        this.cart.items.push({
          product: product,
          quantity: 1,
        });
      }
      product.stocks--;
    },

    // increaseQuantity(cartItem) {
    //     cartItem.product.stocks--;
    //     cartItem.quantity++;
    //   },
    // decreaseQuantity(cartItem) {
    //     cartItem.quantity--;
    //     cartItem.product.stocks++;
    //     if (cartItem.quantity == 0) {
    //       this.removeItemFromCart(cartItem);
    //     }
    //   },
    getCartItem(product) {
      for (var i = 0; i < this.cart.items.length; i++) {
        if (this.cart.items[i].product.id === product.id) {
          return this.cart.items[i];
        }
      }

      return null;
    },
    listWrapper() {
      this.groupWrapper = "list-group-item";
    },
    gridWrapper() {
      this.groupWrapper = "grid-group-item";
    },

    clearSelectCus() {
      this.selected = {};
    },
    clearAddCus() {
      (this.form.name = ""),
        (this.form.contactNo = ""),
        (this.form.address = "");
    },

    print() {
      window.print();
      // var divContents = document.getElementById("printMe").innerHTML;
      // var a = window.open('', '', 'height=1000, width=1500');
      // a.document.write('<html>');
      // a.document.write('<body>');
      // a.document.write(divContents);
      // a.document.write('</body></html>');
      // a.document.close();
      // a.print();
    },

    vars(value) {
      if (value == null) {
        return "info";
      } else {
        return "danger";
      }
    },
  },

  created() {
    this.$Progress.start();
    this.loadCustomers2();

    axios.get("api/profile").then(({ data }) => (this.currentUser = data.data));

    this.$Progress.finish();
    this.petsa();
    this.loadProducts();
    this.loadCategories();

    this.loadGetProductsWithSerialNos();
    this.productsWithSerialNo();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },

    currency: function (value) {
      var formatter = new Intl.NumberFormat("en-US", {
        style: "currency",
        currency: "PHP",
        minimumFractionDigits: 0,
      });
      return formatter.format(value);
    },
    orderdates: function (value) {
      if (value) {
        return moment(String(value)).format("MM/DD/YYYY hh:mm");
      }
    },
  },
  computed: {
    returnDataSelectedCustomer() {
      return this.customerx;
    },
    cartItemsTotal() {
      let a = this.cart.items;
      let x = [];

      for (let i = 0; i < a.length; i++) {
        x.push(a[i].quantity);
      }

      return x.reduce((a, b) => a + b, 0);
    },

    filteredProducts() {
      return this.products.data.filter((product) => {
        const name = product.name.toLowerCase();
        const price = product.price.toString().toLowerCase();
        const description = product.description.toLowerCase();
        const category = product.category.name.toLowerCase();
        const stocks = product.stocks.toString().toLowerCase();
        // const category = product.category.name.toLowerCase();
        // const id = product.id.toString().toLowerCase();

        const search = this.searchProduct.toLowerCase();

        return (
          name.includes(search) ||
          price.includes(search) ||
          description.includes(search) ||
          category.includes(search) ||
          stocks.includes(search)
        );
      });
    },
    cartTotal: function () {
      var total = 0;
      this.cartx2.forEach(function (item) {
        total += item.quantity * item.price;
      });
      return total;
    },
    taxAmount: function () {
      return (this.cartTotal * 10) / 100;
    },

    //  dateToday(){
    //      const current = new Date();
    //     const date = (current.getMonth()+1)+'/'+current.getDate()+"/"+current.getFullYear();

    //     return date;
    //     // return new Date().toLocaleString();
    // },
    returnvalue() {
      let a = this.serial;
      let b = this.ProductsWithSerialNos;
      let c = {};

      for (let i = 0; i < b.length; i++) {
        if (b[i].serialnumber == a) {
          c = b[i];
        }
      }

      return c;
    },

    out() {
      let sernum = [];
      for (let i = 0; i < this.cartx2.length; i++) {
        sernum.push(this.cartx2[i].serialnumber);
      }
      return sernum;
    },

    checkSerialsInCart() {
      let a = this.cartx2;
      let b = [];

      for (let i = 0; i < a.length; i++) {
        b.push(a[i].serialnumber);
      }

      return b;
    },

    ids() {
      let c = this.cartx2.map(z => z.id);
      return c;
    },
    leftx() {
      let a = [];

      for (let i = 0; i < this.cartx2.length; i++) {
        a.push({
          id: this.cartx2[i].ssku,
          qty: this.cartx2[i].quantity,
        });
      }

      return a;
    },
  },
};
</script>
<style scoped>
.content {
  font-family: Arial, Helvetica, sans-serif;
}

#addbutton {
  width: 100%;
}
#navProducts {
  padding: 3px;
}
#navProducts:hover {
  cursor: pointer;
  box-shadow: 0px 0px 2px grey;
  border-radius: 5px;
}
tr:hover {
  cursor: pointer;
  background-color: #eee;
}
#printMe {
  /* display: none;
  background-color: #eee; */

  bottom: 0;
  width: 100%;
}
@media print {
  .noPrint {
    display: none;
  }
  #printMe {
    display: block;
  }
  #spacelang {
    display: none;
  }
  .noPrint {
    display: none;
  }
}
</style>
