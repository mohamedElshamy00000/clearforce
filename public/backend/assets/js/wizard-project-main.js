/**
 *  Form Wizard
 */

 'use strict';

 (function () {
   // Init custom option check
   window.Helpers.initCustomOptionCheck();
 
   const flatpickrRange = document.querySelector('.flatpickr'),
     phoneMask = document.querySelector('.contact-number-mask'),
     plCountry = $('#plCountry'),
     plFurnishingDetailsSuggestionEl = document.querySelector('#plFurnishingDetails');
 
   // Phone Number Input Mask
   if (phoneMask) {
     new Cleave(phoneMask, {
       phone: true,
       phoneRegionCode: 'US'
     });
   }
 
   // select2 (Country)
 
   if (plCountry) {
     plCountry.wrap('<div class="position-relative"></div>');
     plCountry.select2({
       placeholder: 'Select country',
       dropdownParent: plCountry.parent()
     });
   }
 
   if (flatpickrRange) {
     flatpickrRange.flatpickr();
   }
 
   // Tagify (Furnishing details)
  
   if (plFurnishingDetailsSuggestionEl) {
     const plFurnishingDetailsSuggestion = new Tagify(plFurnishingDetailsSuggestionEl, {
       maxTags: 10,
       dropdown: {
         maxItems: 20,
         classname: 'tags-inline',
         enabled: 0,
         closeOnSelect: false
       }
     });
   }
 
   // Vertical Wizard
   // --------------------------------------------------------------------
 
   const wizardPropertyListing = document.querySelector('#wizard-property-listing');
   if (typeof wizardPropertyListing !== undefined && wizardPropertyListing !== null) {
     // Wizard form
     const wizardPropertyListingForm = wizardPropertyListing.querySelector('#wizard-property-listing-form');
     // Wizard steps
     const wizardPropertyListingFormStep1 = wizardPropertyListingForm.querySelector('#clearance-type');
     const wizardPropertyListingFormStep2 = wizardPropertyListingForm.querySelector('#description-details');
     const wizardPropertyListingFormStep3 = wizardPropertyListingForm.querySelector('#shipment-details');
     const wizardPropertyListingFormStep4 = wizardPropertyListingForm.querySelector('#upload-files');
     // const wizardPropertyListingFormStep5 = wizardPropertyListingForm.querySelector('#price-details');
     // Wizard next prev button
     const wizardPropertyListingNext = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-next'));
     const wizardPropertyListingPrev = [].slice.call(wizardPropertyListingForm.querySelectorAll('.btn-prev'));
 
     const validationStepper = new Stepper(wizardPropertyListing, {
       linear: true
     });
 
     // Personal Details
     const FormValidation1 = FormValidation.formValidation(wizardPropertyListingFormStep1, {
       fields: {
         // * Validate the fields here based on your requirements
         plClearanceType : {
           validators: {
             notEmpty: {
               message: 'Please check Clearance Type to continue'
             }
           }
         }
       },
 
       plugins: {
         trigger: new FormValidation.plugins.Trigger(),
         bootstrap5: new FormValidation.plugins.Bootstrap5({
           // Use this for enabling/changing valid/invalid class
           // eleInvalidClass: '',
           eleValidClass: '',
         }),
         autoFocus: new FormValidation.plugins.AutoFocus(),
         submitButton: new FormValidation.plugins.SubmitButton()
       },
       init: instance => {
         instance.on('plugins.message.placed', function (e) {
           //* Move the error message out of the `input-group` element
           if (e.element.parentElement.classList.contains('input-group')) {
             e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
           }
         });
       }
     }).on('core.form.valid', function () {
       // Jump to the next step when all fields in the current step are valid
       validationStepper.next();
     });
 
     // Property Details
     const FormValidation2 = FormValidation.formValidation(wizardPropertyListingFormStep2, {
       fields: {
         // * Validate the fields here based on your requirements
         
         // plGoodsType: {
         //   validators: {
         //     notEmpty: {
         //       message: 'Please select property type'
         //     }
         //   }
         // },
         
         'plShsearch[]': {
           validators: {
             notEmpty: {
               message: 'Please enter SH code OR Goods Type'
             },
             // stringLength: {
             //   min: 4,
             //   max: 10,
             //   message: 'The zip code must be more than 4 and less than 10 characters long'
             // }
           }
         }
       },
 
       plugins: {
         
         trigger: new FormValidation.plugins.Trigger(),
         bootstrap5: new FormValidation.plugins.Bootstrap5({
           // Use this for enabling/changing valid/invalid class
           // eleInvalidClass: '',
           eleValidClass: '',
         }),
         autoFocus: new FormValidation.plugins.AutoFocus(),
         submitButton: new FormValidation.plugins.SubmitButton()
       },
       init: instance => {
         instance.on('plugins.message.placed', function (e) {
           //* Move the error message out of the `input-group` element
           if (e.element.parentElement.classList.contains('input-group')) {
             e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
           }
         });
       },
     }).on('core.form.valid', function () {
       // Jump to the next step when all fields in the current step are valid
       validationStepper.next();
     });
 
     // select2 (Property type)
     const plPropertyType = $('#plPropertyType');
     if (plPropertyType.length) {
       plPropertyType.wrap('<div class="position-relative"></div>');
       plPropertyType
         .select2({
           placeholder: 'Select property type',
           dropdownParent: plPropertyType.parent()
         })
         .on('change.select2', function () {
           // Revalidate the color field when an option is chosen
           FormValidation2.revalidateField('plPropertyType');
         });
     }
 
     // Property Features
     const FormValidation3 = FormValidation.formValidation(wizardPropertyListingFormStep3, {
       fields: {
         // * Validate the fields here based on your requirements
         plTransportationType : {
           validators: {
             notEmpty: {
               message: 'Please select Transportation Type to continue'
             }
           }
         },
         plports: {
           validators: {
             notEmpty: {
               message: 'Please select Transportation Type then select ports'
             }
           }
         },
         plBill: {
           validators: {
             notEmpty: {
               message: 'Please select Bill number'
             }
           }
         },
         plCountryFrom: {
           validators: {
             notEmpty: {
               message: 'Please check Clearance Type to continue'
             }
           }
         },
         plCountryTo: {
           validators: {
             notEmpty: {
               message: 'Please check Country to continue'
             }
           }
         },
         plArrival: {
           validators: {
             notEmpty: {
               message: 'Please select Date'
             }
           }
         }
       },
 
       plugins: {
         trigger: new FormValidation.plugins.Trigger(),
         bootstrap5: new FormValidation.plugins.Bootstrap5({
           // Use this for enabling/changing valid/invalid class
           // eleInvalidClass: '',
           eleValidClass: '',
         }),
         autoFocus: new FormValidation.plugins.AutoFocus(),
         submitButton: new FormValidation.plugins.SubmitButton()
       },
       init: instance => {
         instance.on('plugins.message.placed', function (e) {
           //* Move the error message out of the `input-group` element
           if (e.element.parentElement.classList.contains('input-group')) {
             e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
           }
         });
       },
     }).on('core.form.valid', function () {
       validationStepper.next();
     });
 
     // upload-files
     // const FormValidation4 = FormValidation.formValidation(wizardPropertyListingFormStep4, {
     //   fields: {
     //     // * Validate the fields here based on your requirements
     //   },
     //   plugins: {
     //     trigger: new FormValidation.plugins.Trigger(),
     //     bootstrap5: new FormValidation.plugins.Bootstrap5({
     //       // Use this for enabling/changing valid/invalid class
     //       // eleInvalidClass: '',
     //       eleValidClass: '',
     //       rowSelector: '.col-md-12'
     //     }),
     //     autoFocus: new FormValidation.plugins.AutoFocus(),
     //     submitButton: new FormValidation.plugins.SubmitButton()
     //   }
     // }).on('core.form.valid', function () {
     //   // Jump to the next step when all fields in the current step are valid
     //   validationStepper.next();
     // });
 
     // upload-files
     const FormValidation4 = FormValidation.formValidation(wizardPropertyListingFormStep4, {
       fields: {
         // * Validate the fields here based on your requirements
         'media[]': {
           validators: {
               notEmpty: {
                   message: 'Please select an file',
               },
               file: {
                   extension: 'doc,pdf,docx,pptx,zip,png,jpg,jpeg',
                   
                   maxSize: 2097152, // 2048 * 1024
                   message: 'The selected file is not valid',
               },
           },
         },
        
       },
       plugins: {
         trigger: new FormValidation.plugins.Trigger(),
         bootstrap5: new FormValidation.plugins.Bootstrap5({
           // Use this for enabling/changing valid/invalid class
           // eleInvalidClass: '',
           eleValidClass: '',
         }),
         autoFocus: new FormValidation.plugins.AutoFocus(),
         submitButton: new FormValidation.plugins.SubmitButton()
       }
     }).on('core.form.valid', function () {
       // You can submit the form
 
 
       // ----
 
       const deliveryPlace = $('#deliveryPlace').val().trim();
       // console.log(deliveryPlace); 
       // console.log($('#needShiping').is(":checked")); 
       if ($('#needShiping').is(":checked") == true && deliveryPlace == '') {
         toastr.success("Once the transfer is activated, the delivery Place must not be left empty");
         $('#deliveryPlace').addClass('is-invalid');
         $('#needShipingData').fadeIn();
         validationStepper.previous();
         validationStepper.previous();
       } else {
         wizardPropertyListingForm.submit();
       }
       
       // ----
 
       // or send the form data to server via an Ajax request
       // To make the demo simple, I just placed an alert
 
     });
 
     wizardPropertyListingNext.forEach(item => {
       item.addEventListener('click', event => {
         // When click the Next button, we will validate the current step
         switch (validationStepper._currentIndex) {
           case 0:
             FormValidation1.validate();
             break;
 
           case 1:
             FormValidation2.validate();
             break;
 
           case 2:
             FormValidation3.validate();
             break;
 
           case 3:
             FormValidation4.validate();
             break;
 
           // case 4:
           //   FormValidation5.validate();
           //   break;
 
           default:
             break;
         }
       });
     });
 
     wizardPropertyListingPrev.forEach(item => {
       item.addEventListener('click', event => {
         switch (validationStepper._currentIndex) {
           // case 4:
           //   validationStepper.previous();
           //   break;
 
           case 3:
             validationStepper.previous();
             break;
 
           case 2:
             validationStepper.previous();
             break;
 
           case 1:
             validationStepper.previous();
             break;
 
           case 0:
 
           default:
             break;
         }
       });
     });
   }
 })();
 