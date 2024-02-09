<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $titlePage; ?></h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <?php
                if (isset($template['breadcrumbs']) && is_array($template['breadcrumbs'])) {
                ?>
                    <ol class="breadcrumb float-sm-right">
                        <?php
                        $breadcrumb = $template['breadcrumbs'];
                        for ($i = 0; $i < count($breadcrumb); $i++) {
                            echo $i == (count($breadcrumb) - 1) ? '<li class="breadcrumb-item active">' : '<li class="breadcrumb-item">';
                            echo $i != (count($breadcrumb) - 1) ? '<a href="' . $breadcrumb[$i]['uri'] . '">' . $breadcrumb[$i]['name'] . '</a>' : $breadcrumb[$i]['name'];
                            echo '</li>';
                        }
                        ?>
                    </ol>
                <?php
                }
                ?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>