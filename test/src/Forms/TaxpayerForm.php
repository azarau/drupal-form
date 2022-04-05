<?php

namespace Drupal\form_api_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class TaxpayerForm extends FormBase {

  public function buildForm(array $form, FormStateInterface $form_state) {

    // tin, mda, address, phone, contact_name, email, taxes

    $form['description'] = [
      '#type' => 'item',
      '#markup' => $this->t('SET UP INPUT FORM'),
    ];

    $form['mda'] = [
      '#type' => 'textfield',
      '#title' => $this->t('MDA'),
    ];

    $form['ngo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('NGO'),
    ];

      
    $form['organization_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ORGANIZATION NAME'),
    ];

    $form['phone'] = [
        '#type' => 'textfield',
        '#title' => $this->t('PHONE'),
    ];
  
    $form['total_no_empl'] = [
      '#type' => 'textfield',
      '#title' => $this->t('TOTAL NO. EMPL') 
    ];

    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('ADDRESS'),
    ];

    
    $form['contact_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('CONTACT NAME'),
    ];

    $form['commencement_date'] = [
      '#type' => 'date',
      '#title' => $this->t('COMMENCEMENT DATE'),
    ];
      
    $form['nature_of_business'] = [
      '#type' => 'textfield',
      '#title' => $this->t('NATURE OF BUSINESS'),
    ];
      

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email Address'),
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
    return 'taxpayer_form';
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $mda = $form_state->getValue('mda');
    $ngo = $form_state->getValue('ngo');
    $organization_name = $form_state->getValue('organization_name');
    $phone = $form_state->getValue('phone');
    $total_no_empl = $form_state->getValue('total_no_empl');
    $address = $form_state->getValue('address');
    $contact_name = $form_state->getValue('contact_name');
    $commencement_date = $form_state->getValue('commencement_date');
    $nature_of_business = $form_state->getValue('nature_of_business');
    $email = $form_state->getValue('email');
   
    $query = \Drupal::database()->insert('_taxpayer');
    $query->fields([
      'mda',
      'ngo',
      'organization_name',
      'phone',
      'total_no_empl',
      'address',
      'contact_name',
      'commencement_date',
      'nature_of_business',
      'email',
      
    ]);
    $query->values([
      $mda,
      $ngo,
      $organization_name,
      $phone,
      $total_no_empl,
      $address,
      $contact_name,
      $commencement_date,
      $nature_of_business,
      $email,
      
    ]);
    $query->execute();





    $this->messenger()->addMessage($this->t('You have successfully added record'));
  }

}