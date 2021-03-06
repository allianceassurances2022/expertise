Vue.component('v-select', VueSelect.VueSelect);

var app = new Vue({
     el: "#root",
     data: {
        message: ' ',
        showingAddModel: false,
        ODS_subtotal:0,
        ODS_total:0,
        ODS_tr : 0,
        // main_oeuvre : 0,
        // immobilisation : 0,
        // Autres : 0,
        // MHT_choc : 0,
        // MTC_choc : 0,
        newOds : {description:'',piece:'',piece_id:'' ,price:0, nb:1 , total:0 } ,
        autrenewOds : {libelle:'',price:0, nb:1 , total:0 } ,
        categorieOptions : [],
        PiecesOptions : [],
        odsLines:[],
        AutreodsLines:[],
        choc:'',
        editAct:'',
        estat:''
     },
     mounted() {
     	// console.log("mounted start ok");
        // this.categorieOption();
        this.PiecesOption();
        this.editAct = $("#editAct").val();
        this.chocInfo();
        this.odsLinesOption();
        this.AutreOdsLinesOption();

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
            console.log( typeof(catId) );
            if(typeof(catId) !== 'undefined' || catId !== null){
            let cat = this.categorieOptions.find(el => el.id === catId);
            // => {name: "Albania", code: "AL"}
            //console.log(cat['pieces']);
            return cat ? cat['pieces'] : null;
            }else{
                return null;
            }
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

            // console.log(this.odsLines);

        },
        editPiece(){
            for(var i= 0; i < this.odsLines.length; i++)
            {
                var piece = this.PiecesOptions.find(el => el.id === this.odsLines[i].piece_id);
                this.odsLines[i].piece = piece;

            }

        },
        odsLinesOption: function() {
                let that = this;
                $.ajax({
                   type:'POST',
                   datatype:'JSON',
                   url: $("#URL_fournitures_choc").val(),
                   data:{'_token': function () {
                                return $('input[name="_token"]').val();
                            }},
                   success:function(data){
                     that.odsLines = data;
                     that.calculateTotal();
                     that.categorieOption();
                     },
                   error:function(error) {
                    alert('erreur de chargement!');
                       console.log(error);
                   }
                });
             },
        AutreOdsLinesOption: function() {
                let that = this;
                $.ajax({
                   type:'POST',
                   datatype:'JSON',
                   url: $("#URL_autre_fournitures_choc").val(),
                   data:{'_token': function () {
                                return $('input[name="_token"]').val();
                            }},
                   success:function(data){
                     that.AutreodsLines = data;
                     that.calculateTotal();
                     that.categorieOption();
                     that.editPiece();
                     },
                   error:function(error) {
                    alert('erreur de chargement!');
                       console.log(error);
                   }
                });
             },
        chocInfo: function() {
                let that = this;
                $.ajax({
                   type:'post',
                   datatype:'JSON',
                    data:{'_token': function () {
                                return $('input[name="_token"]').val();
                            }},
                   url: $("#URL_choc").val(),
                   success:function(data){
                     that.choc = data;
                     // that.odsLinesOption();
                     },
                   error:function(error) {
                       console.log(error);
                   }
                });
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
                     // that.odsLinesOption();
                     },
                   error:function(error) {
                       console.log(error);
                   }
                });
             },
        saveODS() {
            $formulaire =JSON.stringify($("#choc_details").serializeArray());
            $dataInfo = JSON.stringify([{ 'ODS_lines':this.odsLines,'ODS_lines2':this.AutreodsLines, 'ODS_total':this.ODS_total}]);

            if ($('#vetuste').val() < 0 || $('#vetuste').val() > 60 ){
                alert('le taux de la v??tust?? doit etre >= 0 ou <= 60');
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
                     alert('L\'enregistrement a ??t?? fait!');
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
     		// this.odsLines.push({description:'', price:0, nb:0 , total:'' });
     		this.odsLines.splice(index + 1, 0, {description:'',piece:'',piece_id:'', price:0, nb:1 , total:0});

     // 		$('.select2').select2({
					// 	theme: "bootstrap", tags :true
					// });
     	},
        AutreaddOdsLine(index) {
            alert("Ne pas allouer des fournitures avec AUTRES sauf pi??ce non existante dans la liste");

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
     	},
        deleteOdsLine(index, odsLine) {
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

            //var total =parseFloat(this.choc.main_oeuvre)+parseFloat(this.choc.immobilisation)+parseFloat(this.choc.Autres)+parseFloat(this.ODS_total);
            var tva =0;
            var total =parseFloat(this.choc.main_oeuvre)+parseFloat(this.choc.Autres)+parseFloat(this.ODS_total);
            if (this.choc.non_tva == 0){
                tva =parseFloat(this.ODS_total)*0.19;
                total = total + tva ;
            }
            var tota_t = total;
            this.choc.main_oeuvre=parseFloat(this.choc.main_oeuvre).toFixed(2);
            this.choc.immobilisation=parseFloat(this.choc.immobilisation).toFixed(2);
            this.choc.Autres=parseFloat(this.choc.Autres).toFixed(2);

            this.choc.TVA = tva.toFixed(2);
            this.choc.MTC_choc = tota_t.toFixed(2);
        },

     }
 });


