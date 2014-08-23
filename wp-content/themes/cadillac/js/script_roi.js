jQuery(document).ready(function() {
	console.log("test");
	calcTotal();
	console.log("test");
	jQuery('.servers').on({
		slide : function() {
			jQuery('.xervmon_servers').val(jQuery(this).val(), {
				set : true
			});
			var serversCount = jQuery('.input_servers').val();
			if (serversCount < 100) {
				jQuery('.input_employees').val(2);
				jQuery('.employees').val(2, {
					set : true
				});
			}
			if (serversCount > 100 && serversCount < 150) {
				jQuery('.input_employees').val(3);
				jQuery('.employees').val(3, {
					set : true
				});
			}
			if (serversCount > 150 && serversCount < 200) {
				jQuery('.input_employees').val(4);
				jQuery('.employees').val(4, {
					set : true
				});
			}
			if (serversCount > 200 && serversCount < 250) {
				jQuery('.input_employees').val(5);
				jQuery('.employees').val(5, {
					set : true
				});
			}
			if (serversCount > 250 && serversCount < 300) {
				jQuery('.input_employees').val(6);
				jQuery('.employees').val(6, {
					set : true
				});
			}
			if (serversCount > 300 && serversCount < 350) {
				jQuery('.input_employees').val(7);
				jQuery('.employees').val(7, {
					set : true
				});
			}
			if (serversCount > 350 && serversCount < 400) {
				jQuery('.input_employees').val(8);
				jQuery('.employees').val(8, {
					set : true
				});
			}
			if (serversCount > 400 && serversCount < 450) {
				jQuery('.input_employees').val(9);
				jQuery('.employees').val(9, {
					set : true
				});
			}
			if (serversCount > 450 && serversCount < 500) {
				jQuery('.input_employees').val(10);
				jQuery('.employees').val(10, {
					set : true
				});
			}
		}
	});
	jQuery('.xervmon_servers').on({
		slide : function() {
			jQuery('.servers').val(jQuery(this).val(), {
				set : true
			});
			var xervmonServersCount = jQuery('.input_xervmon_servers').val();
			if (xervmonServersCount < 100) {
				jQuery('.input_employees').val(2);
				jQuery('.employees').val(2, {
					set : true
				});
			}
			if (xervmonServersCount > 100 && xervmonServersCount < 150) {
				jQuery('.input_employees').val(3);
				jQuery('.employees').val(3, {
					set : true
				});
			}
			if (xervmonServersCount > 150 && xervmonServersCount < 200) {
				jQuery('.input_employees').val(4);
				jQuery('.employees').val(4, {
					set : true
				});
			}
			if (xervmonServersCount > 200 && xervmonServersCount < 250) {
				jQuery('.input_employees').val(5);
				jQuery('.employees').val(5, {
					set : true
				});
			}
			if (xervmonServersCount > 250 && xervmonServersCount < 300) {
				jQuery('.input_employees').val(6);
				jQuery('.employees').val(6, {
					set : true
				});
			}
			if (xervmonServersCount > 300 && xervmonServersCount < 350) {
				jQuery('.input_employees').val(7);
				jQuery('.employees').val(7, {
					set : true
				});
			}
			if (xervmonServersCount > 350 && xervmonServersCount < 400) {
				jQuery('.input_employees').val(8);
				jQuery('.employees').val(8, {
					set : true
				});
			}
			if (xervmonServersCount > 400 && xervmonServersCount < 450) {
				jQuery('.input_employees').val(9);
				jQuery('.employees').val(9, {
					set : true
				});
			}
			if (xervmonServersCount > 450 && xervmonServersCount < 500) {
				jQuery('.input_employees').val(10);
				jQuery('.employees').val(10, {
					set : true
				});
			}
		}
	});
	jQuery('.servers').on({
		change : function() {
			jQuery('.xervmon_servers').val(jQuery(this).val(), {
				set : true
			});
		}
	});
	jQuery('.xervmon_servers').on({
		change : function() {
			jQuery('.servers').val(jQuery(this).val(), {
				set : true
			});
		}
	});

	jQuery('.servers , .xervmon_servers , .employees , .salaryperemployee , .serveice_moniters , [name=radio2]').on({
		change : function() {
			calcTotal();
		}
	});
	var dateSliderInitialized = false;
	console.log("test");
	jQuery(".servers").noUiSlider({
		start : [10],
		step : 1,
		range : {
			'min' : [10],
			'max' : [500]
		},
		serialization : {
			decimals : 0,
			lower : [jQuery.Link({
				target : jQuery(".input_servers"),
				format : {
					decimals : 0
				}
			})]
		},
	}, dateSliderInitialized);
	dateSliderInitialized = true;
	jQuery(".xervmon_servers").noUiSlider({
		start : [10],
		step : 1,
		range : {
			'min' : [10],
			'max' : [500]
		},
		serialization : {
			decimals : 0,
			lower : [jQuery.Link({
				target : jQuery(".input_xervmon_servers"),
				format : {
					decimals : 0
				}
			})]
		},
	});
	jQuery(".employees").noUiSlider({
		start : [2],
		step : 1,
		range : {
			'min' : [2],
			'max' : [20]
		},
		serialization : {
			decimals : 0,
			lower : [jQuery.Link({
				target : jQuery(".input_employees"),
				format : {
					decimals : 0
				}
			})]
		},
	});
	jQuery(".salaryperemployee").noUiSlider({
		start : [80000],
		step : 1,
		range : {
			'min' : [80000],
			'max' : [200000]
		},
		serialization : {
			decimals : 0,
			lower : [jQuery.Link({
				target : jQuery(".input_salary_employee"),
				format : {
					decimals : 0
				}
			})]
		},
	});
	jQuery(".serveice_moniters").noUiSlider({
		start : [0],
		step : 1,
		range : {
			'min' : [0],
			'max' : [50]
		},
		serialization : {
			decimals : 0,
			lower : [jQuery.Link({
				target : jQuery(".input_service_moniter"),
				format : {
					decimals : 0
				}
			})]
		},
	});
});

function addCommas(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function calcTotal() {
	var type_cost = [0.25, 1.00, 0.65, 0.50];

	var your_servers = $(".input_servers").val();
	var your_people = $(".input_employees").val();
	var your_salary = $(".input_salary_employee").val();
	var xervmon_servers = $(".input_xervmon_servers").val();
	var xervmon_monitors = $(".input_service_moniter").val();
	var type = $('[name=radio2]:checked').val() || 0;
	console.log(your_servers);
	console.log(your_people);
	console.log(your_salary);
	console.log(xervmon_servers);
	console.log(xervmon_monitors);
	console.log(type);
	// Calculations zone
	var yourCost = Math.round(your_people * your_salary / 12 | 0);
	var xervmonCost = Math.round((xervmon_servers * type_cost[type]) * 730);
	var savings = Math.max(0, (yourCost - xervmonCost) * 12);
	var savingPercent = Math.round((savings / (yourCost * 12)) * 100);
	jQuery("#your_cost").text(addCommas(yourCost));
	jQuery("#xervmon_cost").text(addCommas(xervmonCost));
	jQuery("#you_save").text(addCommas(savings));
	jQuery("#you_save_percent").text(addCommas(savingPercent));
}
