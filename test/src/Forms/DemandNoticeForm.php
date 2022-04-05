<?php

namespace Drupal\form_api_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class DemandNoticeForm extends FormBase {

  public function buildForm(array $form, FormStateInterface $form_state) {

    // tin, name, address, phone, contact_name, email, taxes

    $form['tin'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Tin'),
      // '#required' => TRUE,
    ];

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
    ];

    $form['phone'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Phone'),
      ];

    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
    ];

    

    $form['contact_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Contact Name'),
    ];

    $form['business_types'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Business Types'),
      ];
  
    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
    ];

    
    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form. This is not required, but is convention.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function getFormId() {
    return 'demand_notice_form';
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $tin = $form_state->getValue('tin');
    $name = $form_state->getValue('name');
    $phone = $form_state->getValue('phone');
    $address = $form_state->getValue('address');
    $contact_name = $form_state->getValue('contact_name');
    $business_types = $form_state->getValue('business_types');
    $email = $form_state->getValue('email');
    

   
    $query = \Drupal::database()->insert('_demandnotice');
    $query->fields([
      'tin',
      'name',
      'phone',
      'address',
      'contact_name',
      'business_types',
      'email',
      
      
    ]);
    $query->values([
      $tin,
      $name,
      $address,
      $phone,
      $contact_name,
      $business_types,
      $email,
      
      
    ]);
    $query->execute();





    $this->messenger()->addMessage($this->t('You have successfully added record'));
  }

}