/**
 * Tour
 */

'use strict';

(function () {
  const startBtn = document.querySelector('#shepherd-example');

  function setupTour(tour) {
    const backBtnClass = 'btn btn-sm btn-label-secondary md-btn-flat',
      nextBtnClass = 'btn btn-sm btn-primary btn-next';
    tour.addStep({
      title: 'menu',
      // scrollTo: true,
      text: 'You can access projects, invoices, and support',
      attachTo: { element: '.menu', on: 'bottom' },
      buttons: [
        {
          action: tour.cancel,
          classes: backBtnClass,
          text: 'Skip'
        },
        {
          text: 'Next',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'Add project',
      // scrollTo: true,
      text: 'You can add a project from here',
      attachTo: { element: '.addproject', on: 'top' },
      buttons: [
        {
          text: 'Skip',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Back',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'Next',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'statistics',
      // scrollTo: true,
      text: 'This is the Some important statistics',
      attachTo: { element: '.dash-header', on: 'top' },
      buttons: [
        {
          text: 'Skip',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Back',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'Next',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'projects',
      text: 'your projects',
      // scrollTo: true,
      attachTo: { element: '.myprojects', on: 'top' },
      buttons: [
        {
          text: 'Skip',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Back',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'Next',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'my Invoices',
      text: 'your Invoices',
      // scrollTo: true,
      attachTo: { element: '.myinvoices', on: 'top' },
      buttons: [
        {
          text: 'Skip',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Back',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'Next',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    
    tour.addStep({
      title: 'License',
      scrollTo: true,
      text: 'Click here to show License',
      attachTo: { element: '.footer-link', on: 'top' },
      buttons: [
        {
          text: 'Back',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'Finish',
          classes: nextBtnClass,
          action: tour.cancel
        }
      ]
    });

    return tour;
  }

  if (startBtn) {
    // On start tour button click
    startBtn.onclick = function () {
      const tourVar = new Shepherd.Tour({
        defaultStepOptions: {
          scrollTo: false,
          cancelIcon: {
            enabled: true
          }
        },
        useModalOverlay: true
      });

      setupTour(tourVar).start();
    };
  }

  // ! Documentation Tour only
  const startBtnDocs = document.querySelector('#shepherd-docs-example');

  function setupTourDocs(tour) {
    const backBtnClass = 'btn btn-sm btn-label-secondary md-btn-flat',
      nextBtnClass = 'btn btn-sm btn-primary btn-next';
    tour.addStep({
      title: 'Navbar',
      text: 'This is your navbar',
      attachTo: { element: '.navbar', on: 'bottom' },
      buttons: [
        {
          action: tour.cancel,
          classes: backBtnClass,
          text: 'Skip'
        },
        {
          text: 'Next',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'Footer',
      text: 'This is the Footer',
      attachTo: { element: '.footer', on: 'top' },
      buttons: [
        {
          text: 'Skip',
          classes: backBtnClass,
          action: tour.cancel
        },
        {
          text: 'Back',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'Next',
          classes: nextBtnClass,
          action: tour.next
        }
      ]
    });
    tour.addStep({
      title: 'Social Link',
      text: 'Click here share on social media',
      attachTo: { element: '.footer-link', on: 'top' },
      buttons: [
        {
          text: 'Back',
          classes: backBtnClass,
          action: tour.back
        },
        {
          text: 'Finish',
          classes: nextBtnClass,
          action: tour.cancel
        }
      ]
    });

    return tour;
  }

  if (startBtnDocs) {
    // On start tour button click
    startBtnDocs.onclick = function () {
      const tourDocsVar = new Shepherd.Tour({
        defaultStepOptions: {
          scrollTo: false,
          cancelIcon: {
            enabled: true
          }
        },
        useModalOverlay: true
      });

      setupTourDocs(tourDocsVar).start();
    };
  }
})();
