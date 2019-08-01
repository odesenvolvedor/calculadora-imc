jQuery(document).ready(function ($) {
    ///////////////////
    $("#bmibmrCalc").submit(function (e) {
        e.preventDefault();

        var formData = $("#bmibmrCalc").serializeArray();
        var URL = $("#bmibmrCalc").attr("action");
        $.post(URL,
                formData,
                function (data, textStatus, jqXHR) {
                    calculateDivMetric(data);
                }).fail(function (jqXHR, textStatus, errorThrown) {
        });
    });

    ///////////////////
    function calculateDivMetric(outData) {
        var parsData = jQuery.parseJSON(outData);
        var weight = parsData.weight, height = parsData.height;
        weight = weight.replace(",", ".");
        height = height.replace(",", "");
        height = height.replace(".", "");

        formdataSave = outData;
        if (parsData.uVal == 'kg') {
            var bmiindex = weight / ((height / 100) * (height / 100));
        } else {
            var bmiindex = weight / ((height) * (height)) * 703;
        }

        if (parsData.height && parsData.weight) {
            $('#bmibmrRes').html('<h3>Seu IMC é: <strong>' + bmiindex + '</strong></h3>');
            //$('#bmibmrRes').append('<br>Note:<br> '+parsData.descriptionB);

            $('#bmibmrRes').append('<div id="data-panel"> \
		  	<div class="col-md-6">\
				<table class="table table-striped">\
				  <tr>\
				  	<td>Abaixo do peso</td>\
				  	<td>menos que 20</td>\
				  </tr>\
				   <tr>\
				  	<td>Normal</td>\
				  	<td>20-25</td>\
				  </tr>\
				  <tr>\
				  	<td>Excesso de peso</td>\
				  	<td>25-30</td>\
				  </tr>\
				  <tr>\
				  	<td>Obeso</td>\
				  	<td>30-40</td>\
				  </tr>\
				  <tr>\
				  	<td>Obesidade mórbida</td>\
				  	<td>mais que 40</td>\
				  </tr>\
				</table>\
			</div>\
		</div>');

            $('#bmiloggedin').html('<hr> Por estar logado, você pode <br/><strong><a id="saveBData" href="#">Salvar dados</a></strong> <br />e recuperá-lo a qualquer momento, fazendo login!');
            $('.notauser').html('<h4 style="color:#FF5C00;">Usuários registrados podem salvar dados para referência posterior!</h4>');



            if ($('#bmrCheck').val()) {
                var calcFront = $("#bmibmrCalc").serializeArray();
                var URL = $("#calcFront").attr("data-calcFront");
                $.post(URL,
                        calcFront,
                        function (data, textStatus, jqXHR) {
                            $("#bmibmrRes").prepend(data);
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                });
            };

        } else {
            $('#bmibmrRes').html('<h3 style="color:red;">Digite TODOS os dados</h3>');
            $('#bmiloggedin').empty();
        }
    }

    $('.calcValues').on("change", "#uVal", function () {
        var element = $(this).find('option:selected');
        var byTag = element.attr("data-matchV");
        $('#mVal option[data-matchV="' + byTag + '"]').attr('selected', 'selected');
    });
    $('.calcValues').on("change", "#mVal", function () {
        //$("#uVal").val($(this).val());
        var element = $(this).find('option:selected');
        var byTag = element.attr("data-matchV");
        $('#uVal option[data-matchV="' + byTag + '"]').attr('selected', 'selected');
    });

    ///////////////////
    $('.calcValues').on("click", "#bfatguide_btn", function (ev) {
        ev.preventDefault();
        $(".bfatguide").slideDown();
    });

    ///////////////////
    $('.calcValues').on("click", "#f_close", function (ev) {
        ev.preventDefault();
        ev.stopPropagation;
        $(".bfatguide").slideUp();

    });

    ///////////////////

    $('#bmi').click(function (eve) {
        eve.preventDefault();
        var datapanel = $("#data-panel");
        $(datapanel).hide();
        var formPath = $(this).attr("data-formPath");
        $(datapanel).load(formPath);
        $(datapanel).fadeIn("fast");
    });
    $('#bmr').click(function (eve) {
        eve.preventDefault();
        var datapanel = $("#data-panel");
        $(datapanel).hide();
        var formPath = $(this).attr("data-formPath");
        $(datapanel).load(formPath);
        $(datapanel).fadeIn("fast");
    });

    $('#clients').click(function (eve) {
        eve.preventDefault();

        var URL = $(this).attr("data-formPath");
        $.post(URL,
                function (data, textStatus, jqXHR) {
                    $("#clientlist").empty();
                    var userData = $.parseJSON(data);

                    $("#clientlist").append("<ul>");
                    $.each(userData, function () {
                        $("#clientlist").append("<li class='clientitem' data-userid='" + this.ID + "' ><strong>" + this.user_login + "</strong>, <i>" + this.user_email + "</i></li>");
                    });
                    $("#clientlist").append("</ul>");
                    $("#clientlistbtn").click();

                }).fail(function (jqXHR, textStatus, errorThrown) {
        });
    });

    $(document).on("click", '.clientitem', function () {


        var pluginURL = $("#hiddenppath").attr("data-Path");

        var clientID = $(this).attr("data-userid");

        $.ajax({
            url: pluginURL + "/calculadora-imc/includes/client.php",
            data: {
                'clientid': clientID
            },
            success: function (data) {
                console.log(data);

                var datapanel = $("#data-panel");
                $(datapanel).empty();
                $(datapanel).hide();
                $(datapanel).html(data);
                $(datapanel).fadeIn("fast");

                //hide modal
                $('#myModal').modal('hide');
                getSavedData(clientID);


            },
            error: function (errorThrown) {
                //console.log(errorThrown);
            }
        });


    });



    //////////////////////////////////
    function bmibmr_save() {
        var holdData = jQuery.parseJSON(formdataSave);
        console.log(holdData);
        $.ajax({
            url: ajaxurl,
            data: {
                'action': 'bmibmr_save',
                'holdData': holdData
            },
            success: function (data) {
                location.reload(true);
            },
            error: function (errorThrown) {
                //console.log(errorThrown);
            }
        });
    }

    ///////////////////////////////
    $(document).on("click", "#saveBData", function (ev) {
        ev.preventDefault();
        bmibmr_save();
    });

    //////////////////////////////
    $('.btn-group').button();

    $('body').on("click", "#uVal1", function (ev) {
        $("#weight").html("libras (lbs)");
        $("#height").html("polegadas (in)");
    });

    $('body').on("click", "#uVal2", function (ev) {
        $("#weight").html("Quilo (kg)");
        $("#height").html("Centímetros] (cm)");
    });


    //get saved data
    function loadMbrForm(formPath) {

        $("#data-panel").hide();
        $("#data-panel").load(formPath);
        $("#data-panel").fadeIn("fast");

    }

    var formPath = $(this).attr("data-formPath");

    loadMbrForm(formPath);


});
jQuery(document).ready(function ($) {

    // Input radio-group visual controls
    $('.radio-group label').on('click', function () {
        $(this).removeClass('not-active').siblings().addClass('not-active');
    });
});

function SomenteNumeros(e) {
    var tecla = (window.event) ? event.keyCode : e.which;
    if ((tecla > 47 && tecla < 58))
        return true;
    else {
        if (tecla == 8 || tecla == 0)
            return true;
        else
            return false;
    }
}

function SomenteNumero(e) {
    var tecla = (window.event) ? event.keyCode : e.which;
    if ((tecla > 47 && tecla < 58))
        return true;
    else {
        if (tecla == 8 || tecla == 0)
            return true;
        else
        if (tecla == 44 || tecla == 46)
            return true;
        return false;
    }
}