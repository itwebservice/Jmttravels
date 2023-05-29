// Off display dummy data in inputs/fields
$(function () {
	$('form').attr('autocomplete', 'off');
	$('input').attr('autocomplete', 'off');
});
//Visa Search From submit
$(function () {
	$('#frm_visa_search').validate({
		rules         : {},
		submitHandler : function (form) {
			var base_url = $('#base_url').val();
			var base_url_b2c = $('#crm_base_url').val();
			var country_id = $('#visa_country_filter').val();

			var visa_array = [];
			visa_array.push({
				'country_id' : country_id
			})
			$.post(base_url_b2c+'controller/visa_master/search_session_save.php', { visa_array: visa_array }, function (data) {
				window.location.href = base_url + 'view/visa/visa-listing.php';
			});
		}
	});
});



function saveDataVisa() {
	// get fields
	var base_url = $('#base_url').val();
	var customer_id = $('#customer_id').val();
	var cust_first_name = $('#cust_first_name').val();
	var cust_middle_name = '';
	var cust_last_name = '';
	var gender = $('#cust_gender').val();
	var cust_birth_date = $('#cust_birth_date').val();
	var age = '';
	var contact_no = $('#cust_contact_no').val();
	var email_id = $('#cust_email_id').val();
	var address = '';
	var address2 = '';
	var city = '';
	var service_tax_no = '';
	var landline_no = '';
	var alt_email_id = '';
	var company_name = '';
	var cust_type = 'Walkin';
	var country_code = '';
	var state = '';
	var active_flag = 'Active';
	var branch_admin_id = '1';
	var financial_year_id = $('#financial_year_id').val();
	var credit_charges = '';
	var credit_card_details = '';
	var currency_code = '';

	var credit_amount = '';
	var emp_id = '0';
	var visa_issue_amount = $('#visa_issue_amount').val();
	var service_charge = '0';
	var service_tax_subtotal = '';
	var roundoff = '0';
	var visa_total_cost = $('#visa_total_cost').val();
	var due_date = $('#due_date').val();
	var booking_date = $('#booking_date').val();

	var payment_date = $('#payment_date').val();
	var payment_amount = $('#payment_amount').val();
	var payment_mode = $('#payment_mode').val();
	var bank_name = $('#bank_name').val();
	var transaction_id = '';
	var bank_id = '';
	var markup = $('#markup').val();
	var service_tax_markup = $('#service_tax_markup').val();
	//get fields
	//get table fields
	var first_name_arr = new Array();
	var middle_name_arr = new Array();
	var last_name_arr = new Array();
	var birth_date_arr = new Array();
	var adolescence_arr = new Array();
	var visa_country_name_arr = new Array();
	var visa_type_arr = new Array();
	var passport_id_arr = new Array();
	var issue_date_arr = new Array();
	var expiry_date_arr = new Array();
	var nationality_arr = new Array();
	//var received_documents_arr = new Array();
	var appointment_date_arr = new Array();

	var table = document.getElementById("tbl_dynamic_visa");
	var rowCount = table.rows.length;

	for (var i = 0; i < rowCount; i++) {
		var row = table.rows[i];
		if (rowCount == 1) {
			if (!row.cells[0].childNodes[0].checked) {
				error_msg_alert("Atleast one passenger is required!");
				$('#btn_visa_master_save').prop('disabled', false);
				return false;
			}
		}
		if (row.cells[0].childNodes[0].checked) {
			var first_name = row.cells[2].childNodes[0].value;
			var middle_name = row.cells[3].childNodes[0].value;
			var last_name = row.cells[4].childNodes[0].value;
			var birth_date = row.cells[5].childNodes[0].value;
			var adolescence = row.cells[6].childNodes[0].value;
			var visa_country_name = row.cells[7].childNodes[0].value;
			var visa_type = row.cells[8].childNodes[0].value;
			var passport_id = row.cells[9].childNodes[0].value;
			var issue_date = row.cells[10].childNodes[0].value;
			var expiry_date = row.cells[11].childNodes[0].value;
			var nationality = row.cells[12].childNodes[0].value;
			//var received_documents = "";
			// $(row.cells[13]).find('option:selected').each(function() {
			// 	received_documents += $(this).attr('value') + ',';
			// });
			// received_documents = received_documents.trimChars(",");
			var appointment = row.cells[13].childNodes[0].value;
			var msg = "";

			if (first_name == "") {
				msg += "First name is required in row:" + (i + 1) + "<br>";
			}

			if (visa_country_name == "") {
				msg += "Visa Country name is required in row:" + (i + 1) + "<br>";
			}
			if (visa_type == "") {
				msg += "Visa Type is required in row:" + (i + 1) + "<br>";
			}
			if (nationality == "") {
				msg += "Nationality is required in row:" + (i + 1) + "<br>";
			}
			if (msg != "") {
				error_msg_alert(msg);
				$('#btn_visa_master_save').prop('disabled', false);
				return false;
			}

			first_name_arr.push(first_name);
			middle_name_arr.push(middle_name);
			last_name_arr.push(last_name);
			birth_date_arr.push(birth_date);
			adolescence_arr.push(adolescence);
			visa_country_name_arr.push(visa_country_name);
			visa_type_arr.push(visa_type);
			passport_id_arr.push(passport_id);
			issue_date_arr.push(issue_date);
			expiry_date_arr.push(expiry_date);
			nationality_arr.push(nationality);
			//received_documents_arr.push(received_documents);
			appointment_date_arr.push(appointment);
		}
	}
	// get table fields
	//customer ajax
	$.ajax({
		type: 'post',
		url: base_url + 'controller/customer_master/customer_save.php',
		data: {
			first_name: cust_first_name,
			middle_name: cust_middle_name,
			last_name: cust_last_name,
			gender: gender,
			birth_date: cust_birth_date,
			age: age,
			contact_no: contact_no,
			email_id: email_id,
			address: address,
			address2: address2,
			city: city,
			active_flag: active_flag,
			service_tax_no: service_tax_no,
			landline_no: landline_no,
			alt_email_id: alt_email_id,
			company_name: company_name,
			cust_type: cust_type,
			state: state,
			branch_admin_id: branch_admin_id,
			country_code: country_code
		},
		success: function(result) {
			var error_arr = result.split('--');
			if (error_arr[0] == 'error') {
				error_msg_alert(error_arr[1]);
				$('#btn_visa_master_save').button('reset');
				$('#btn_visa_master_save').prop('disabled', false);
				return false;
			} else {
				//ajax
				$.ajax({
					type: 'post',
					url: base_url + 'controller/visa_passport_ticket/visa/visa_master_save.php',
					data: {
						emp_id: '0',
						customer_id: customer_id,
						visa_issue_amount: visa_issue_amount,
						service_charge: "0.00",
						service_tax_subtotal: service_tax_subtotal,
						visa_total_cost: visa_total_cost,
						payment_date: payment_date,
						payment_amount: payment_amount,
						payment_mode: payment_mode,
						bank_name: bank_name,
						transaction_id: transaction_id,
						first_name_arr: first_name_arr,
						middle_name_arr: middle_name_arr,
						last_name_arr: last_name_arr,
						birth_date_arr: birth_date_arr,
						adolescence_arr: adolescence_arr,
						visa_country_name_arr: visa_country_name_arr,
						visa_type_arr: visa_type_arr,
						passport_id_arr: passport_id_arr,
						issue_date_arr: issue_date_arr,
						expiry_date_arr: expiry_date_arr,
						nationality_arr: nationality_arr,
						//received_documents_arr: received_documents_arr,
						appointment_date_arr: appointment_date_arr,
						bank_id: bank_id,
						due_date: due_date,
						balance_date: booking_date,
						branch_admin_id: branch_admin_id,
						financial_year_id: financial_year_id,
						markup: markup,
						service_tax_markup: service_tax_markup,
						reflections: reflections,
						bsmValues: bsmValues,
						roundoff: roundoff,
						credit_charges: credit_charges,
						credit_card_details: credit_card_details,
						currency_code: currency_code
					},
					success: function(result) {
						var msg = result.split('-');

						if (msg[0] == 'error') {
							$('#btn_visa_master_save').prop('disabled', false);
							msg_alert(result);
							$('#btn_visa_master_save').button('reset');
						} else {
							var msg1 = result.split('-');
							$('#btn_visa_master_save').prop('disabled', false);
							$('#btn_visa_master_save').button('reset');
							msg_alert(msg1[0]);
							reset_form('frm_visa_save');
							$('#visa_save_modal').modal('hide');
							visa_customer_list_reflect();
							window.open(base_url + 'view/vendor/dashboard/estimate/estimate_save_modal.php?type=Visa Booking&amount=' + visa_issue_amount + '&booking_id=' + msg1[1]);
							setTimeout(() => {
								if ($('#whatsapp_switch').val() == "on") whatsapp_send(emp_id, customer_id, booking_date, base_url, country_code + contact_no, email_id);
							}, 1000);
						}
					}
				});
				//    ajax end
			}
		}
	});

	//customer ajax



}
