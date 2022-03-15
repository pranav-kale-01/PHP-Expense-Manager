<?php 
    include_once "../init.php";

    //User login check
    if ($getFromU->loggedIn() === false) {
        header('Location: ../index.php');
    }

    include_once 'admin-skeleton.php'; 
    
    if (isset($_SESSION['swal']))
    {
        echo $_SESSION['swal'];
        unset($_SESSION['swal']);
    }

    // Budget validity checker 
    $budget_validity = $getFromB->budget_validity_checker('_');
    if($budget_validity == false)
    {
        $getFromB->del_budget_record('_');
    }

    // Today's Expenses
    $today_expense = $getFromE->Expenses('_',0);
    if($today_expense == NULL)
    {
        $today_expense = "No Expenses Logged Today";
    }
    else
    {
        $today_expense = "₹ ".$today_expense;
    }

    // Yesterday's Expenses
    $Yesterday_expense = $getFromE->Yesterday_expenses('_');
    if($Yesterday_expense == NULL)
    {
        $Yesterday_expense = "No Expenses Logged Yesterday";
    }
    else
    {
        $Yesterday_expense = "₹ ".$Yesterday_expense;
    }

    // Last 7 Days' Expenses 
    $week_expense = $getFromE->Expenses('_',6);
    if($week_expense == NULL)
    {
        $week_expense = "No Expenses Logged This Week";
    }
    else
    {
        $week_expense = "₹ ".$week_expense;
    }

    // Last 30 Days' Expenses
    $monthly_expense = $getFromE->Expenses('_',29);
    if($monthly_expense == NULL)
    {
        $monthly_expense = "No Expenses Logged This Month";
    }


    
    else
    {
        $monthly_expense = "₹ ".$monthly_expense;
    }

    // Total Expenses
    $total_expenses = $getFromE->totalexp('_');
    if($total_expenses == NULL)
    {
        $total_expenses = "No Expenses Logged Yet";
    }
    else
    {
        $total_expenses = "₹ ".$total_expenses;
    }


    // Budget Left for the month
    $budget_left = $getFromB->checkbudget('_');
    if($budget_left == NULL)
    {
        $budget_left = "Not Set Yet";
    }
    else
    {
        $currmonexp = $getFromE->Current_month_expenses('_');
        if($currmonexp==NULL)
        {
            $currmonexp = 0;
        }
        $budget_left = $budget_left - $currmonexp;
        $budget_left = "₹ ".$budget_left;
    }

?>
    <div class="wrapper">
        <div class="row">
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-danger">
                        <p><i class="fas fa-tasks"></i></p>
                        <h3>
                            Today's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $today_expense ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-primary">
                        <p><i class="fas fa-spinner"></i></p>
                        <h3>
                            Yesterday's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $Yesterday_expense ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-warning">
                        <p><i class="fas fa-calendar-week"></i></p>
                        <h3>
                            Last 7 day's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $week_expense ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-success">
                        <p><i class="fas fa-calendar"></i></p>
                        <h3>
                            Last 30 day's Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $monthly_expense ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-danger bg-vio">
                        <p><i class="fas fa-rupee-sign"></i></p>
                        <h3>
                            Monthly Budget Left
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $budget_left ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-m-6 col-sm-6">
                <div class="card">
                    <div class="counter bg-yell">
                        <p><i class="fa fa-calculator" aria-hidden="true"></i></p>
                        <h3>
                            Total Expenses
                        </h3>
                        <p style="font-size: 1.2em;">
                            <?php echo $total_expenses ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>