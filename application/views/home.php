<div class="row">
	<div class="col-xs-4">Select Your Build</div>
	<div class="col-xs-4">
            <select class="form-control" id='selectBuildID'>
                {options}
            </select>
	</div>
	<div class="col-xs-2">
            <button type="submit" class="btn" id="confirm-select">Select</button>
	</div>
</div>
<div class="row">
    <form action="" method="post">
        <div class="col-xs-4">
            Name:
        </div>
        <div class="col-xs-4">
            <input class="form-control" id="create-build-name" type="text" name="name">
        </div>
        <div class="col-xs-2">
            <input class="btn" id="create-build" type="submit" value="Create New">
        </div>
    </form>
    <div class="col-xs-2">
        <button type="submit" class="btn" id="save-build">Save</button>
    </div>
</div>
<hr />
<div class="row">
    {category-headers}
</div>
<div class="row">
    {category}
</div>
<div class="picture-box" style="">
    {images}
</div>
</div>