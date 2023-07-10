<?php


namespace App\Http\Livewire\Loans;

use Illuminate\Contracts\View\Factory;
use Livewire\Component;



use Illuminate\Support\Facades\Session;
use Livewire\WithFileUploads;
use App\Models\Members;
use App\Models\AccountsModel;
use App\Models\Branches;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\loan_images;
use App\Models\LoansModel;
use App\Models\Loan_sub_products;
use App\Models\loans_schedules;
use App\Models\loans_summary;
use Carbon\Carbon;

use App\Models\issured_shares;
use App\Models\general_ledger;

class Assessment extends Component
{


    use WithFileUploads;

    public $photo;

    public $collateral_type;
    public $collateral_description;
    public $daily_sales;
    public $loan;
    public $collateral_value;
    public $loan_sub_product;
    public $tenure = '12';
    public $principle_amount;
    public $member;


    public $guarantor;
    public $disbursement_account;
    public $collection_account_loan_interest;
    public $collection_account_loan_principle;
    public $collection_account_loan_charges;
    public $collection_account_loan_penalties;
    public $principle_min_value;
    public $principle_max_value;
    public $min_term;
    public $max_term;
    public $interest_value;
    public $principle_grace_period;
    public $interest_grace_period;
    public $amortization_method;
    public $days_in_a_month;
    public $loan_id;
    public $loan_account_number;

    public $member_number;


    public $interest;
    public $business_licence_number;
    public $business_tin_number;
    public $business_inventory;
    public $cash_at_hand;

    public $cost_of_goods_sold;
    public $operating_expenses;
    public $monthly_taxes;
    public $other_expenses;
    public $monthly_sales;
    public $gross_profit;
    public $table;
    public $tablefooter;
    public $recommended_tenure;
    public $recommended_installment;
    public $recommended = true;
    public $business_age;
    public $bank1;


    public function boot(): void
    {

        $this->loan = LoansModel::where('id', Session::get('currentloanID'))->get();

        foreach ($this->loan as $theloan) {
            $this->loan_id = $theloan->loan_id;
            $this->loan_account_number = $theloan->loan_account_number;
            $this->loan_sub_product = $theloan->loan_sub_product;
            $this->member_number = $theloan->member_number;

            $this->guarantor = $theloan->guarantor;
            $this->principle_amount = $theloan->principle_amount;
            $this->interest = $theloan->interest;

            $this->business_licence_number = $theloan->business_licence_number;
            $this->business_tin_number = $theloan->business_tin_number;
            $this->business_inventory = $theloan->business_inventory;

            $this->cash_at_hand = $theloan->cash_at_hand;
            $this->daily_sales = $theloan->daily_sales;
            $this->cost_of_goods_sold = $theloan->cost_of_goods_sold;

            $this->operating_expenses = $theloan->operating_expenses;
            $this->monthly_taxes = $theloan->monthly_taxes;
            $this->other_expenses = $theloan->other_expenses;

            $this->collateral_value = $theloan->collateral_value;
            $this->collateral_type = $theloan->collateral_type;
            $this->tenure = $theloan->tenure;
            $this->business_age = $theloan->business_age;

            $this->status = $theloan->status;

        }

        $this->products = Loan_sub_products::where('product_id', $this->loan_sub_product)->get();

        foreach ($this->products as $product) {
            $this->disbursement_account = $product->disbursement_account;
            $this->collection_account_loan_interest = $product->collection_account_loan_interest;
            $this->collection_account_loan_principle = $product->collection_account_loan_principle;
            $this->collection_account_loan_charges = $product->collection_account_loan_charges;

            $this->collection_account_loan_penalties = $product->collection_account_loan_penalties;
            $this->principle_min_value = $product->principle_min_value;
            $this->principle_max_value = $product->principle_max_value;

            $this->min_term = $product->min_term;
            $this->max_term = $product->max_term;
            $this->interest_value = $product->interest_value;

            $this->principle_grace_period = $product->principle_grace_period;
            $this->interest_grace_period = $product->interest_grace_period;
            $this->amortization_method = $product->amortization_method;

            $this->days_in_a_month = $product->days_in_a_month;


        }

        $this->guarantor = Members::where('membership_number', $this->guarantor)->get();
        $this->member = Members::where('membership_number', $this->member_number)->get();


    }

    public function render(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        if($this->tenure){

        }else{
            $this->tenure = '12';
        }
        if($this->principle_amount){
            LoansModel::where('id', Session::get('currentloanID'))->update([
                'principle_amount' => $this->principle_amount,
                'tenure' => $this->tenure
            ]);
        }


        $this->loan = LoansModel::where('id', Session::get('currentloanID'))->get();

        foreach ($this->loan as $theloan) {

            $this->principle_amount = $theloan->principle_amount;

            $this->tenure = $theloan->tenure;

        }


        $this->monthly_sales = (double)$this->daily_sales * (double)$this->days_in_a_month;
        $this->gross_profit = $this->monthly_sales - (double)$this->cost_of_goods_sold;
        $this->net_profit = $this->gross_profit - (double)$this->monthly_taxes;
        $this->available_funds = ($this->net_profit - (double)$this->other_expenses) / 2;

        $interest = $this->interest_value / 12;


        if ($this->recommended) {

            $this->print_schedule($this->principle_amount, $interest, $this->available_funds);

        } else {

            $payment = $this->calc_payment($this->principle_amount, $this->tenure, $interest, 2);

            $this->print_schedule($this->principle_amount, $interest, $payment);

        }


        return view('livewire.loans.assessment');
    }


    public function actionBtns($x)
    {
        if ($x == 1) {
            $this->recommended = false;
        }
        if ($x == 2) {
            $this->recommended = true;
        }
        if ($x == 3) {
            $this->commit();
        }
        if ($x == 4) {
            $this->approve();
        }
        if ($x == 5) {
            $this->reject();
        }
        if ($x == 6) {
            $this->disburse();
        }

    }

    public function commit()
    {
        if ($this->recommended) {

            LoansModel::where('id', Session::get('currentloanID'))->update([
                'principle_amount' => $this->principle_amount,
                'tenure' => $this->recommended_tenure,
                'available_funds'=> $this->available_funds,
                'status'=> 'Awaiting Approval'
            ]);
            Session::flash('loan_commit', 'The loan has been committed!');
            Session::flash('alert-class', 'alert-success');

        } else {

            LoansModel::where('id', Session::get('currentloanID'))->update([
                'principle_amount' => $this->principle_amount,
                'tenure' => $this->tenure,
                'available_funds'=> $this->available_funds,
                'status'=> 'Awaiting Approval'
            ]);

            Session::flash('loan_commit', 'The loan has been committed!');
            Session::flash('alert-class', 'alert-success');
        }

        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
        $this->emit('currentloanID');

    }

    public function approve(){
        LoansModel::where('id', Session::get('currentloanID'))->update([
            'status'=> 'Approved'
        ]);

        Session::flash('loan_commit', 'The loan has been Approved!');
        Session::flash('alert-class', 'alert-success');

        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
        $this->emit('currentloanID');
    }

    public function reject(){
        LoansModel::where('id', Session::get('currentloanID'))->update([
            'status'=> 'Rejected'
        ]);

        Session::flash('loan_commit', 'The loan has been Rejected!');
        Session::flash('alert-class', 'alert-danger');

        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
        $this->emit('currentloanID');
    }

    public function disburse(){

        LoansModel::where('id', Session::get('currentloanID'))->update([
            'status'=> 'Active',
            'bank_account_number'=> $this->bank1
        ]);


        $next_due_date = Carbon::now()->toDateTimeString();

        foreach ($this->table as $installment) {


            $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));

            $product = new loans_schedules;
            $product->loan_id = $this->loan_id;
            $product->installment = $installment['Payment'];
            $product->interest = $installment['Interest'];
            $product->principle = $installment['Principle'];
            $product->balance = $installment['balance'];
            $product->bank_account_number = $this->bank1;
            $product->completion_status = "Active";
            $product->account_status = "Active";
            $product->installment_date = $next_due_date;
            $product->save();

        }

        foreach ($this->tablefooter as $installment) {


            $next_due_date = date('Y-m-d', strtotime($next_due_date. ' +30 days'));

            $product = new loans_summary;
            $product->loan_id = $this->loan_id;
            $product->installment = $installment['Payment'];
            $product->interest = $installment['Interest'];
            $product->principle = $installment['Principle'];
            $product->balance = $installment['balance'];
            $product->bank_account_number = $this->bank1;
            $product->completion_status = "Active";
            $product->account_status = "Active";
            $product->save();

        }

        $this->processPayment();

        Session::flash('loan_commit', 'The loan has been Approved!');
        Session::flash('alert-class', 'alert-success');

        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
        $this->emit('currentloanID');
    }





    public function processPayment()
    {

        $institution_id = '';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User) {
            $institution_id = $User->team_id;
        }


        $mirror_account = AccountsModel::where('account_number', $this->bank1)->value('mirror_account');

        $savings_account_new_balance = (double)AccountsModel::where('account_number', $this->loan_account_number)->value('balance') + (double)$this->principle_amount;

        $savings_ledger_account_new_balance = (double)AccountsModel::where('account_number', $mirror_account)->value('balance') - (double)$this->principle_amount;

        $partner_bank_account_new_balance = (double)AccountsModel::where('account_number', $this->bank1)->value('balance') + (double)$this->principle_amount;

        AccountsModel::where('account_number', $this->loan_account_number)->update(['balance' => $savings_account_new_balance]);
        AccountsModel::where('account_number', $mirror_account)->update(['balance' => $savings_ledger_account_new_balance]);
        AccountsModel::where('account_number', $this->bank1)->update(['balance' => $partner_bank_account_new_balance]);

        $reference_number = time();


        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number' => $this->loan_account_number,
            'record_on_account_number_balance' => $savings_account_new_balance,
            'sender_branch_id' => $institution_id,
            'beneficiary_branch_id' => $institution_id,
            'sender_product_id' => AccountsModel::where('account_number', $mirror_account)->value('product_number'),
            'sender_sub_product_id' => AccountsModel::where('account_number', $mirror_account)->value('sub_product_number'),
            'beneficiary_product_id' => AccountsModel::where('account_number', $this->loan_account_number)->value('product_number'),
            'beneficiary_sub_product_id' => AccountsModel::where('account_number', $this->loan_account_number)->value('sub_product_number'),
            'sender_id' => '999999',
            'beneficiary_id' => $this->member_number,
            'sender_name' => 'Organization',
            'beneficiary_name' => Members::where('membership_number', $this->member_number)->value('first_name') . ' ' . Members::where('membership_number', $this->member_number)->value('middle_name') . ' ' . Members::where('membership_number', $this->member_number)->value('last_name'),
            'sender_account_number' => $mirror_account,
            'beneficiary_account_number' => $this->loan_account_number,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => 'Loan disbursement',
            'credit' => (double)$this->principle_amount,
            'debit' => 0,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'partner_bank_account_number' => $this->bank1,
            'partner_bank_transaction_reference_number' => $reference_number,
        ]);

        //CREDIT RECORD SHARE ACCOUNT
        general_ledger::create([
            'record_on_account_number' => $this->bank1,
            'record_on_account_number_balance' => $partner_bank_account_new_balance,
            'sender_branch_id' => $institution_id,
            'beneficiary_branch_id' => $institution_id,
            'sender_product_id' => AccountsModel::where('account_number', $this->loan_account_number)->value('product_number'),
            'sender_sub_product_id' => AccountsModel::where('account_number', $this->loan_account_number)->value('sub_product_number'),
            'beneficiary_product_id' => AccountsModel::where('account_number', $this->bank1)->value('product_number'),
            'beneficiary_sub_product_id' => AccountsModel::where('account_number', $this->bank1)->value('sub_product_number'),
            'sender_id' => $this->member_number,
            'beneficiary_id' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'sender_name' => Members::where('membership_number', $this->member_number)->value('first_name') . ' ' . Members::where('membership_number', $this->member_number)->value('middle_name') . ' ' . Members::where('membership_number', $this->member_number)->value('last_name'),
            'beneficiary_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'sender_account_number' => $this->loan_account_number,
            'beneficiary_account_number' => $this->bank1,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => 'Loan Disbursement',
            'credit' => (double)$this->principle_amount,
            'debit' => 0,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'partner_bank_account_number' => $this->bank1,
            'partner_bank_transaction_reference_number' => $reference_number,
        ]);

        //CREDIT RECORD GL
        general_ledger::create([
            'record_on_account_number' => $mirror_account,
            'record_on_account_number_balance' => $savings_ledger_account_new_balance,
            'sender_branch_id' => $institution_id,
            'beneficiary_branch_id' => $institution_id,
            'sender_product_id' => AccountsModel::where('account_number', $mirror_account)->value('product_number'),
            'sender_sub_product_id' => AccountsModel::where('account_number', $mirror_account)->value('sub_product_number'),
            'beneficiary_product_id' => AccountsModel::where('account_number', $this->loan_account_number)->value('product_number'),
            'beneficiary_sub_product_id' => AccountsModel::where('account_number', $this->loan_account_number)->value('sub_product_number'),
            'sender_id' => '999999',
            'beneficiary_id' => $this->loan_account_number,
            'sender_name' => AccountsModel::where('account_number', $mirror_account)->value('account_name'),

            'beneficiary_name' => Members::where('membership_number', $this->member_number)->value('first_name') . ' ' . Members::where('membership_number', $this->member_number)->value('middle_name') . ' ' . Members::where('membership_number', $this->member_number)->value('last_name'),
            'sender_account_number' => $mirror_account,
            'beneficiary_account_number' => $this->loan_account_number,
            'transaction_type' => 'IFT',
            'sender_account_currency_type' => 'TZS',
            'beneficiary_account_currency_type' => 'TZS',
            'narration' => 'Loan Disbursement',
            'credit' => 0,
            'debit' => (double)$this->principle_amount,
            'reference_number' => $reference_number,
            'trans_status' => 'Successful',
            'trans_status_description' => 'Successful',
            'swift_code' => '',
            'destination_bank_name' => '',
            'destination_bank_number' => '',
            'payment_status' => 'Successful',
            'recon_status' => 'Pending',
            'partner_bank' => AccountsModel::where('account_number', $this->bank1)->value('institution_number'),
            'partner_bank_name' => AccountsModel::where('account_number', $this->bank1)->value('account_name'),
            'partner_bank_account_number' => $this->bank1,
            'partner_bank_transaction_reference_number' => $reference_number,
        ]);



    }








    function calc_principal($payno, $int, $pmt)
    {
// check that required values have been supplied
        if (empty($payno)) {
            echo "<p class='error'>a value for NUMBER of PAYMENTS is required</p>";
            exit;
        } // if
        if (empty($int)) {
            echo "<p class='error'>a value for INTEREST RATE is required</p>";
            exit;
        } // if
        if (empty($pmt)) {
            echo "<p class='error'>a value for PAYMENT is required</p>";
            exit;
        } // if

// now do the calculation using this formula:

//******************************************
//             ((1 + INT) ** PAYNO) - 1
// PV = PMT * --------------------------
//            INT * ((1 + INT) ** PAYNO)
//******************************************

        $int = $int / 100;        //convert to percentage
        $value1 = (pow((1 + $int), $payno)) - 1;
        $value2 = $int * pow((1 + $int), $payno);
        $pv = $pmt * ($value1 / $value2);
        $pv = number_format($pv, 2, ".", "");

        return $pv;

    } // calc_principal ==================================================================


    function calc_number($pv, $int, $pmt)
    {
// check that required values have been supplied
        if (empty($pv)) {
            echo "<p class='error'>a value for PRINCIPAL is required</p>";
            exit;
        } // if
        if (empty($int)) {
            echo "<p class='error'>a value for INTEREST RATE is required</p>";
            exit;
        } // if
        if (empty($pmt)) {
            echo "<p class='error'>a value for PAYMENT is required</p>";
            exit;
        } // if

// now do the calculation using this formula:

//******************************************
//         log(1 - INT * PV/PMT)
// PAYNO = ---------------------
//             log(1 + INT)
//******************************************

        $int = $int / 100;
        $value1 = log(1 - $int * ($pv / $pmt));
        $value2 = log(1 + $int);
        $payno = $value1 / $value2;
        $payno = abs($payno);
        $payno = number_format($payno, 0, ".", "");

        return $payno;

    } // calc_number =====================================================================

    function calc_rate($pv, $payno, $pmt)
    {
// check that required values have been supplied
        if (empty($pv)) {
            echo "<p class='error'>a value for PRINCIPAL is required</p>";
            exit;
        } // if
        if (empty($payno)) {
            echo "<p class='error'>a value for NUMBER of PAYMENTS is required</p>";
            exit;
        } // if
        if (empty($pmt)) {
            echo "<p class='error'>a value for PAYMENT is required</p>";
            exit;
        } // if

// now try and guess the value using the binary chop technique
        $GuessHigh = (float)100;    // maximum value
        $GuessMiddle = (float)2.5;    // first guess
        $GuessLow = (float)0;      // minimum value
        $GuessPMT = (float)0;      // result of test calculation

        do {
            // use current value for GuessMiddle as the interest rate,
            // and set level of accurracy to 6 decimal places
            $GuessPMT = (float)calc_payment($pv, $payno, $GuessMiddle, 6);

            if ($GuessPMT > $pmt) {    // guess is too high
                $GuessHigh = $GuessMiddle;
                $GuessMiddle = $GuessMiddle + $GuessLow;
                $GuessMiddle = $GuessMiddle / 2;
            } // if

            if ($GuessPMT < $pmt) {    // guess is too low
                $GuessLow = $GuessMiddle;
                $GuessMiddle = $GuessMiddle + $GuessHigh;
                $GuessMiddle = $GuessMiddle / 2;
            } // if

            if ($GuessMiddle == $GuessHigh) break;
            if ($GuessMiddle == $GuessLow) break;

            $int = number_format($GuessMiddle, 9, ".", "");    // round it to 9 decimal places
            if ($int == 0) {
                echo "<p class='error'>Interest rate has reached zero - calculation error</p>";
                exit;
            } // if

        } while ($GuessPMT !== $pmt);

        return $int;

    } // calc_rate =======================================================================

    function calc_payment($pv, $payno, $int, $accuracy)
    {


// now do the calculation using this formula:

//******************************************
//            INT * ((1 + INT) ** PAYNO)
// PMT = PV * --------------------------
//             ((1 + INT) ** PAYNO) - 1
//******************************************

        $int = $int / 100;    // convert to a percentage
        $value1 = $int * pow((1 + $int), $payno);
        $value2 = pow((1 + $int), $payno) - 1;
        $pmt = $pv * ($value1 / $value2);
// $accuracy specifies the number of decimal places required in the result
        $pmt = number_format($pmt, $accuracy, ".", "");

        return $pmt;

    } // calc_payment ====================================================================

    function print_schedulex($balance, $rate, $payment)
    {
        // check that required values have been supplied
        if (empty($balance)) {
            echo "<p class='error'>a value for PRINCIPAL is required</p>";
            exit;
        } // if
        if (empty($rate)) {
            echo "<p class='error'>a value for INTEREST RATE is required</p>";
            exit;
        } // if
        if (empty($payment)) {
            echo "<p class='error'>a value for PAYMENT is required</p>";
            exit;
        } // if

        echo '<table border="1">';
        echo '<colgroup align="right" width="20">';
        echo '<colgroup align="right" width="115">';
        echo '<colgroup align="right" width="115">';
        echo '<colgroup align="right" width="115">';
        echo '<colgroup align="right" width="115">';
        echo '<tr><th>#</th><th>PAYMENT</th><th>INTEREST</th><th>PRINCIPAL</th><th>BALANCE</th></tr>';

        $count = 0;
        do {
            $count++;

            // calculate interest on outstanding balance
            $interest = $balance * $rate / 100;

            // what portion of payment applies to principal?
            $principal = $payment - $interest;

            // watch out for balance < payment
            if ($balance < $payment) {
                $principal = $balance;
                $payment = $interest + $principal;
            } // if

            // reduce balance by principal paid
            $balance = $balance - $principal;

            // watch for rounding error that leaves a tiny balance
            if ($balance < 0) {
                $principal = $principal + $balance;
                $interest = $interest - $balance;
                $balance = 0;
            } // if

            echo "<tr>";
            echo "<td>$count</td>";
            echo "<td>" . number_format($payment, 2, ".", ",") . "</td>";
            echo "<td>" . number_format($interest, 2, ".", ",") . "</td>";
            echo "<td>" . number_format($principal, 2, ".", ",") . "</td>";
            echo "<td>" . number_format($balance, 2, ".", ",") . "</td>";
            echo "</tr>";

            @$totPayment = $totPayment + $payment;
            @$totInterest = $totInterest + $interest;
            @$totPrincipal = $totPrincipal + $principal;

            if ($payment < $interest) {
                echo "</table>";
                echo "<p>Payment < Interest amount - rate is too high, or payment is too low</p>";
                exit;
            } // if

        } while ($balance > 0);

        echo "<tr>";
        echo "<td>&nbsp;</td>";
        echo "<td><b>" . number_format($totPayment, 2, ".", ",") . "</b></td>";
        echo "<td><b>" . number_format($totInterest, 2, ".", ",") . "</b></td>";
        echo "<td><b>" . number_format($totPrincipal, 2, ".", ",") . "</b></td>";
        echo "<td>&nbsp;</td>";
        echo "</tr>";
        echo "</table>";

    } // print_schedule ==================================================================


    function print_schedulek($balance, $rate, $payment)
    {

        print($balance);
        print('<>');
        print($rate);
        print('<>');
        print($payment);




        $totPayment =0;
        $totInterest =0;
        $totPrincipal =0;
        $datalist = array();
        $count = 0;
        do {
            $count++;



            // calculate interest on outstanding balance
            $interest = $balance * $rate / 100;



            // what portion of payment applies to principal?
            $principal = $payment - $interest;

            // watch out for balance < payment
            if ($balance < $payment) {
                $principal = $balance;
                $payment = $interest + $principal;
            } // if

            // reduce balance by principal paid
            $balance = $balance - $principal;

            // watch for rounding error that leaves a tiny balance
            if ($balance < 0) {
                $principal = $principal + $balance;
                $interest = $interest - $balance;
                $balance = 0;
            } // if



            $datalist[] = array(
                "Payment" => $payment,
                "Interest" => $interest,
                "Principle" => $principal,
                "balance" => $balance
            );



            @$totPayment = $totPayment + $payment;

            @$totInterest = $totInterest + $interest;

            @$totPrincipal = $totPrincipal + $principal;



            if ($payment < $interest) {

            } // if

        } while ($balance > 0);
        //dd($balance);

        $datalistfooter[] = array(
            "Payment" => $totPayment,
            "Interest" => $totInterest,
            "Principle" => $totPrincipal,
            "balance" => $balance
        );



        $this->table = $datalist;
        $this->tablefooter = $datalistfooter;
        $this->recommended_tenure = $count;
        $this->recommended_installment = $payment;

    } // print_schedule ==================================================================



    function print_schedule($balance, $rate, $payment)
    {


        $totPayment =0;
        $totInterest =0;
        $totPrincipal =0;
        $datalist = array();
        $count = 0;


        if($balance){

        }else{
            $balance = 0;
        }
        if($payment > 0){

        }else{
            $payment = 0;
        }



        while($balance > 0) {
            $count++;

            // calculate interest on outstanding balance
            $interest = $balance * $rate / 100;

            // what portion of payment applies to principal?
            $principal = $payment - $interest;

            // watch out for balance < payment
            if ($balance < $payment) {
                $principal = $balance;
                $payment = $interest + $principal;
            } // if

            // reduce balance by principal paid
            if($principal < 0 ){
                $balance = 0;
            }else{
                $balance = $balance - $principal;
            }


            // watch for rounding error that leaves a tiny balance
            if ($balance < 0) {
                $principal = $principal + $balance;
                $interest = $interest - $balance;
                $balance = 0;
            } // if



            $datalist[] = array(
                "Payment" => $payment,
                "Interest" => $interest,
                "Principle" => $principal,
                "balance" => $balance
            );



            @$totPayment = $totPayment + $payment;

            @$totInterest = $totInterest + $interest;

            @$totPrincipal = $totPrincipal + $principal;



            if ($payment < $interest) {

            } // if

        }



        $datalistfooter[] = array(
            "Payment" => $totPayment,
            "Interest" => $totInterest,
            "Principle" => $totPrincipal,
            "balance" => $balance
        );



        $this->table = $datalist;
        $this->tablefooter = $datalistfooter;
        $this->recommended_tenure = $count;
        $this->recommended_installment = $payment;


    } // print_schedule ==================================================================



}

