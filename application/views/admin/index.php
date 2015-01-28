<div class="content">


    <!-- echo out the system feedback (error and success messages) -->
    <?php $this->renderFeedbackMessages(); ?>

<h1>AdminArea</h1>

<div class="container">
            
    <div class="row">
        <div class="col-xs-6 col-md-3">
            
            <div class="panel status panel-danger">
                <div class="panel-heading">
                    <h1 class="panel-title text-center">25</h1>
                </div>
                <div class="panel-body text-center">                        
                    <strong>Late</strong>
                </div>
            </div>

        </div>          
        <div class="col-xs-6 col-md-3">
          
            <div class="panel status panel-warning">
                <div class="panel-heading">
                    <h1 class="panel-title text-center"><?php echo count($this->onLoanBooks); ?></h1>
                </div>
                <div class="panel-body text-center">                        
                    <strong><a href="<?php echo URL; ?>admin/onLoan">On Loan</a></strong>
                </div>
            </div>

        </div>
        <div class="col-xs-6 col-md-3">
           
            <div class="panel status panel-success">
                <div class="panel-heading">
                    <h1 class="panel-title text-center"><?php echo count($this->books); ?></h1>
                </div>
                <div class="panel-body text-center">                        
                    <strong><a href="<?php echo URL; ?>admin/archive">Archived</a></strong>
                </div>
            </div>

         
        </div>
        <div class="col-xs-6 col-md-3">
          
            <div class="panel status panel-info">
                <div class="panel-heading">
                    <h1 class="panel-title text-center"><?php echo count($this->availableBooks); ?></h1>
                </div>
                <div class="panel-body text-center">                        
                    <strong><a href="<?php echo URL; ?>admin/availableBooks">Available</a></strong>
                </div>
            </div>

         
        </div>
    </div>

</div>

<hr>


</div>