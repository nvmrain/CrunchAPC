<h1>Item # {id}</h1>
<div class="item-img" style="text-align: center;">
    {itemImg}
</div>
<form role="form" action="/mtce/submit" method="post" class="form-horizontal">
    <div class="form-group">
        {fdescritption}
    </div>
    <div class="form-group">
        {fspeed}
    </div>
    <div class="form-group">
        {fpower}
    </div>
    <div class="form-group">
        {fcost}
    </div>
    <div class="form-group">
        {zsubmit}
    </div>
    <div class="form-group">
        <a href="/mtce/cancel" class="btn btn-danger">
            Cancel
        </a>
    </div>
</form>

<!-- <div>
    <a href="/mtce/delete"><input type="button" value="Delete this todo item"/></a>
</div> -->
{error}