Vue.component('v-select', VueSelect.VueSelect);

var app = new Vue({
     el: "#root",
     data: {
        message: ' ',
        showingAddModel: false,
        ODS_subtotal: 0,
        ODS_total: 0,
        ODS_tr : 0,
        main_oeuvre : 0,
        immobilisation : 0,
        Autres : 0,
        non_tva : 0,
        TVA : 0,
        MTC_choc : 0,
        vetuste : 0,
        vetuste_pneumatique : 0,
        newOds : {description:'',piece:'', piece_id:'', price:0, nb:1, total:0 } ,
        autrenewOds : {libelle:'', price:0, nb:1, total:0 } ,
        categorieOptions : [],
        PiecesOptions : [],
        odsLines:[],
        AutreodsLines:[]
     },
     mounted:function() {
     	// console.log("mounted start ok");
        //this.categorieOption();
        this.PiecesOption();
    },
     // computed:{
     // 		odsLinesTotal(){
     // 			return this.odsLines.filter(function(item) {
     // 				return item.total = item.price * item.nb;
     // 			});
     // 		}
     // },
     methods:{
        onChange(event) {
            console.log(event.target.value)
        },
        getPieceOption(catId){
            let cat = this.categorieOptions.find(el => el.id === catId);
            // => {name: "Albania", code: "AL"}
            console.log(cat['pieces']);
            return cat['pieces'];
        },
        categChange(index, odsLine){
            var idx = this.odsLines.indexOf(odsLine);
            console.log(idx, index);
            if (idx > -1) {
                // this.odsLines.splice(idx, 1);
            }
            console.log(odsLine);
               // this.calculateTotal();
        },
        getCatPiece(index){
            var piece = this.PiecesOptions.find(el => el.id === this.odsLines[index].piece.id);
            this.odsLines[index].piece_id = piece['id'];
            this.odsLines[index].description = piece['cat_pieces'];
            // console.log(this.odsLines[index]);
        },
        PiecesOption: function() {
                let that = this;
                $.ajax({
                   type:'GET',
                   datatype:'JSON',
                   url: $("#URL_option_pieces").val(),
                   success:function(data){
                     that.PiecesOptions = data;
                     },
                   error:function(error) {
                       console.log(error);
                   }
                });
             },
        categorieOption: function() {
                let that = this;
                $.ajax({
                   type:'GET',
                   datatype:'JSON',
                   url: $("#URL_option_categorie").val(),
                   success:function(data){
                     that.categorieOptions = data;
                     },
                   error:function(error) {
                       console.log(error);
                   }
                });
             },
     	testClick(option){
     		alert(option.id);
     	},
     	saveODS() {

            $formulaire =JSON.stringify($("#choc_details").serializeArray());
            $dataInfo = JSON.stringify([{ 'ODS_lines':this.odsLines, 'ODS_lines2':this.AutreodsLines, 'ODS_total':this.ODS_total}]);

            //'ODS_lines':this.AutreodsLines,

            if ($('#vetuste').val() < 0 || $('#vetuste').val() > 60 ){
                alert('le taux de la vétusté doit etre >= 0 ou <= 60');
            }else if ($('#description_choc').val() == ''){
                alert('Merci de saisir le champ description');
            }else if ($('#main_oeuvre').val() == 0 ){
                alert('Merci de saisir la main oeuvre');
            }else{
                $('#btnChocSave').attr('disable',true);
              $.ajax({
                   type:'POST',
                   datatype:'JSON',
                   url: $("#choc_details").attr('action'),
                   data:{ '_token': function () {
                                return $('input[name="_token"]').val();
                            },
                            'lignes': function(){
                             return $dataInfo ;
                            },
                            'formulaire': function(){
                             return $formulaire ;
                            }
                    },
                   success:function(data){
                     console.log(data.url);
                     alert('L\'enregistrement a été fait!');
                     window.location = data.url;

                     },
                   error:function(error) {
                        alert('Erreur d\'enregistrement ');
                       console.log(error);
                       $('#btnChocSave').attr('disable',false);
                   }
                });
          }
        },
     	addOdsLine(index) {

     		this.odsLines.splice(index + 1, 0, {description:'',piece:'' ,piece_id:'', price:0, nb:1 , total:0});

     		// $('.select2').select2({
			// 			theme: "bootstrap", tags :true
			// 		});
     	},
        AutreaddOdsLine(index) {
            alert("Ne pas allouer des fournitures avec AUTRES sauf pièce non existante dans la liste");
            this.AutreodsLines.splice(index + 1, 0, {libelle:'',price:0, nb:1 , total:0});

        },
     	addOdsLinePopup(){
     		this.odsLines.push({description: this.newOds.description, piece_id:this.newOds.piece_id, price:this.newOds.price, nb: this.newOds.nb , total:this.newOds.total });
     		 this.newOds = {description:'',piece_id:'', price:0, nb:1 , total:0 };
     		 this.calculateTotal();
     	},
     	calculateLineTotal(odsLine){
     		var total =  (parseFloat(odsLine.price) * parseFloat(odsLine.nb) );
            if (!isNaN(total)) {
                odsLine.total = total.toFixed(2);
            }
        	this.calculateTotal();
     	},
     	calculateTotal(){
     		var subtotal, total;
            total = this.odsLines.reduce(function (sum, product) {
                var lineTotal = parseFloat(product.total);
                if (!isNaN(lineTotal)) {
                    return sum + lineTotal;
                }
            }, 0)+ this.AutreodsLines.reduce(function (sum, product) {
                var lineTotal = parseFloat(product.total);
                if (!isNaN(lineTotal)) {
                    return sum + lineTotal;
                }
            }, 0);
             this.ODS_total = total.toFixed(2);
             //this.MHT_choc= this.main_oeuvre ;
             //alert(this.main_oeuvre);

              subtotal = this.odsLines.reduce(function (sum, product) {
                var lineTotal = parseFloat(product.price);
                if (!isNaN(lineTotal)) {
                    return sum + lineTotal;
                }
            }, 0)+ this.AutreodsLines.reduce(function (sum, product) {
                var lineTotal = parseFloat(product.price);
                if (!isNaN(lineTotal)) {
                    return sum + lineTotal;
                }
            }, 0);
             this.ODS_subtotal = subtotal.toFixed(2);
             this.someMontant();

             this.message = parseFloat(this.ODS_subtotal) + parseFloat(this.ODS_total) + parseFloat(this.ODS_tr);

            // if (!isNaN(total)) {
            //     this.ODS_total = total.toFixed(2);
            // } else {
            //      this.ODS_total = '0.00'
            // }



            // total = (subtotal * (this.invoice_nb / 100)) + subtotal;
            // total = parseFloat(total);
            // if (!isNaN(total)) {
            //     this.invoice_total = total.toFixed(2);
            // } else {
            //     this.invoice_total = '0.00'
            // }
     	}, deleteOdsLine(index, odsLine) {
            var idx = this.odsLines.indexOf(odsLine);
            console.log(idx, index);
            if (idx > -1) {
                this.odsLines.splice(idx, 1);
            }
            this.calculateTotal();
        },
        AutredeleteOdsLine(index, odsLine) {
            var idx = this.AutreodsLines.indexOf(odsLine);
            console.log(idx, index);
            if (idx > -1) {
                this.AutreodsLines.splice(idx, 1);
            }
            this.calculateTotal();
        },
        someMontant() {

            //var total =parseFloat(this.main_oeuvre)+parseFloat(this.immobilisation)+parseFloat(this.Autres)+parseFloat(this.ODS_total);
            var tva =0;
            var total =parseFloat(this.main_oeuvre)+parseFloat(this.Autres)+parseFloat(this.ODS_total);
            if (this.non_tva == 0){
                tva =parseFloat(this.ODS_total)*0.19;
                total = total + tva ;
            }
            var tota_t = total;
            this.main_oeuvre=parseFloat(this.main_oeuvre).toFixed(2);
            this.immobilisation=parseFloat(this.immobilisation).toFixed(2);
            this.Autres=parseFloat(this.Autres).toFixed(2);

            this.TVA = tva.toFixed(2);
            this.MTC_choc = tota_t.toFixed(2);
        },


     }
 });
