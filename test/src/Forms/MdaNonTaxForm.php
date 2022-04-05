<?php

namespace Drupal\form_api_example\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MdaNonTaxForm extends FormBase {


  public function buildForm(array $form, FormStateInterface $form_state) {

    // tin, mda, address, phone, contact_name, email, taxes

    $form['tin'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Tin'),
      // '#required' => TRUE,
    ];

    $form['mda'] = [
      '#type' => 'textfield',
      '#title' => $this->t('MDA Name'),
    ];

    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
    ];

    $form['phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone'),
    ];

    $form['contact_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Contact Name'),
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
    ];

    $form['taxes'] = [
      '#type' => 'textfield',
      '#title' => $this->t('List of Taxes'),
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
    return 'mda_non_tax_form';
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $tin = $form_state->getValue('tin');
    $mda = $form_state->getValue('mda');
    $address = $form_state->getValue('address');
    $phone = $form_state->getValue('phone');
    $contact_name = $form_state->getValue('contact_name');
    $email = $form_state->getValue('email');
    $taxes = $form_state->getValue('taxes');

   
    $query = \Drupal::database()->insert('_mdanontax');
    $query->fields([
      'tin',
      'mda',
      'address',
      'phone',
      'contact_name',
      'email',
      'taxes',
      
    ]);
    $query->values([
      $tin,
      $mda,
      $address,
      $phone,
      $contact_name,
      $email,
      $taxes,
      
    ]);
    $query->execute();





    $this->messenger()->addMessage($this->t('You have successfully added record'));
  }

}