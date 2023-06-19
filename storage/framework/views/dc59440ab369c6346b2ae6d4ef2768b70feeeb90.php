
<?php $__env->startSection('page_title', 'Admit Student'); ?>
<?php $__env->startSection('content'); ?>
        <div class="card">
            <div class="card-header bg-white header-elements-inline">
                <h6 class="card-title">Please fill The form Below To Admit A New Student</h6>

                <?php echo Qs::getPanelOptions(); ?>

            </div>

            <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation" action="<?php echo e(route('students.store')); ?>" data-fouc>
               <?php echo csrf_field(); ?>
                <h6>Personal data</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name: <span class="text-danger">*</span></label>
                                <input value="<?php echo e(old('name')); ?>" required type="text" name="name" placeholder="Full Name" class="form-control">
                                </div>
                            </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address: <span class="text-danger">*</span></label>
                                <input value="<?php echo e(old('address')); ?>" class="form-control" placeholder="Address" name="address" type="text" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Email address: </label>
                                <input type="email" value="<?php echo e(old('email')); ?>" name="email" class="form-control" placeholder="Email Address">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gender">Gender: <span class="text-danger">*</span></label>
                                <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose..">
                                    <option value=""></option>
                                    <option <?php echo e((old('gender') == 'Male') ? 'selected' : ''); ?> value="Male">Male</option>
                                    <option <?php echo e((old('gender') == 'Female') ? 'selected' : ''); ?> value="Female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Phone:</label>
                                <input value="<?php echo e(old('phone')); ?>" type="text" name="phone" class="form-control" placeholder="" >
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telephone:</label>
                                <input value="<?php echo e(old('phone2')); ?>" type="text" name="phone2" class="form-control" placeholder="" >
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Date of Birth:</label>
                                <input name="dob" value="<?php echo e(old('dob')); ?>" type="text" class="form-control date-pick" placeholder="Select Date...">

                            </div>
                        </div>

                         

                        

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">Upload Passport Photo:</label>
                                <input value="<?php echo e(old('photo')); ?>" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                            </div>
                        </div>
                    </div>

                </fieldset>

                <h6>Student Data</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_class_id">Class: <span class="text-danger">*</span></label>
                                <select onchange="getClassSections(this.value)" data-placeholder="Choose..." required name="my_class_id" id="my_class_id" class="select-search form-control">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $my_classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e((old('my_class_id') == $c->id ? 'selected' : '')); ?> value="<?php echo e($c->id); ?>"><?php echo e($c->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                        </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="section_id">Section: <span class="text-danger">*</span></label>
                                <select data-placeholder="Select Class First" required name="section_id" id="section_id" class="select-search form-control">
                                    <option <?php echo e((old('section_id')) ? 'selected' : ''); ?> value="<?php echo e(old('section_id')); ?>"><?php echo e((old('section_id')) ? 'Selected' : ''); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my_parent_id">Parent: </label>
                                <select data-placeholder="Choose..."  name="my_parent_id" id="my_parent_id" class="select-search form-control">
                                    <option  value=""></option>
                                    <?php $__currentLoopData = $parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e((old('my_parent_id') == Qs::hash($p->id)) ? 'selected' : ''); ?> value="<?php echo e(Qs::hash($p->id)); ?>"><?php echo e($p->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="year_admitted">Year Admitted: <span class="text-danger">*</span></label>
                                <select data-placeholder="Choose..." required name="year_admitted" id="year_admitted" class="select-search form-control">
                                    <option value=""></option>
                                    <?php for($y=date('Y', strtotime('- 10 years')); $y<=date('Y'); $y++): ?>
                                        <option <?php echo e((old('year_admitted') == $y) ? 'selected' : ''); ?> value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                </fieldset>

            </form>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\school_managment\School-Mangment-System\resources\views/pages/support_team/students/add.blade.php ENDPATH**/ ?>