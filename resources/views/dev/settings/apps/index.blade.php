<div class="mb-3 row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Idle Time</label>
    <div class="col-sm-4">
        <input type="number" min="0" max="60" class="form-control" value="{{ $IdleTime->idle_time ?? '0' }}" id="idle_time" name="idle_time" oninput="if(this.value > 60) this.value = 60;">
    </div>
</div>