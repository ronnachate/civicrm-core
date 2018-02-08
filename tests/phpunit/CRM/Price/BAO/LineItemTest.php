<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.7                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2017                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http =>//civicrm.org/licensing        |
 +--------------------------------------------------------------------+
 */

/**
 * Test class for CRM_Price_BAO_LineItem.
 * @group headless
 */
class CRM_Price_BAO_LintItemTest extends CiviUnitTestCase {

    /**
    * @return array
    */
    private function getTestFields() {
        return array(
            'id' => '1',
            'name' => 'contribution_amount',
            'label' => 'Contribution Amount',
            'html_type' => 'Text',
            'is_enter_qty' => '0',
            'weight' => '1',
            'is_display_amounts' => '1',
            'options_per_line' => '1',
            'is_active' => '1',
            'visibility' => 'public',
            'visibility_id' => '1',
            'is_required' => '1',
            'options' => array(
                '1' => array(
                    'id' => '1',
                    'price_field_id' => '1',
                    'name' => 'contribution_amount',
                    'label' => 'Contribution Amount',
                    'amount' => '1,200.00',
                    'weight' => '1',
                    'is_default' => '0',
                    'is_active' => '1',
                    'financial_type_id' => '1',
                    'non_deductible_amount' => '0.00',
                    'visibility_id' => '1',
                )
            )
        );
    }
    private function getReplaceOption() {
        return  array(
            '1' => array(
                'id' => '1',
                'price_field_id' => '1',
                'name' => 'contribution_amount',
                'label' => 'Contribution Amount',
                'amount' => '1 001,200.00',
                'weight' => '1',
                'is_default' => '0',
                'is_active' => '1',
                'financial_type_id' => '1',
                'non_deductible_amount' => '0.00',
                'visibility_id' => '1',
            )
        );
    }
    /**
    * @return array
    */
    private function getTestParams() {

        return array(
            'hidden_custom' => '1',
            'custom_6_-1' => '',
            'custom_5_-1' => '',
            'qfKey' => '0cbee4497963922dd912e06487b64efe_1099',
            'entryURL' => 'http://civicrm.org',
            'check_number' => '',
            'frequency_interval' => '1',
            'frequency_unit' => 'month',
            'installments' => '',
            'hidden_AdditionalDetail' => '1',
            'hidden_Premium' => '1',
            'contact_id' => '45',
            'financial_type_id' => '1',
            'payment_instrument_id' => '4',
            'trxn_id' => 'swadzsf',
            'contribution_status_id' => '1',
            'receive_date' => '02/082018',
            'receive_date_time' => '11 =>34PM',
            'receipt_date' => '',
            'receipt_date_time' => '',
            'cancel_date' => '',
            'cancel_date_time' => '',
            'cancel_reason' => '',
            'price_set_id' => '',
            'total_amount' => '1,200.00',
            'currency' => 'USD',
            'source' => '',
            'pcp_made_through_id' => '',
            'pcp_made_through' => '',
            'pcp_roll_nickname' => '',
            'pcp_personal_note' => '',
            'sct_default_id' => '3',
            'MAX_FILE_SIZE' => '2097152',
            'ip_address' => '10.0.2.2',
            'price_1' => array(
                '1' => 1
            )
        );
    }

  /**
   * @param $stringNumber
   * @param $expectedValue
   */
  public function testLintotalFormatWithThoundsonSeparater() {
    $values = array();
    $fields = $this->getTestFields();
    $params = $this->getTestParams();
    CRM_Price_BAO_LineItem::format(1, $params, $fields, $values);
    $this->assertEquals(1200, $values['1']['line_total']);
    $values = array();
    $fields['options'] = $this->getReplaceOption();
    $params[''] = '1 001,200.00';
    CRM_Price_BAO_LineItem::format(1, $params, $fields, $values);
    $this->assertEquals(1001200, $values['1']['line_total']);
  }

}
