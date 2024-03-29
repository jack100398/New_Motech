<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">站台</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <select class="form-control" onchange="location = this.value;">
            <option value="{{ route($route) }}" selected>全選
            </option>
            <option value="{{ route($route, ['site' => 'zh']) }}" {{ $site === 'zh' ? 'selected' : '' }}>
                中文站
            </option>
            <option value="{{ route($route, ['site' => 'en']) }}" {{ $site === 'en' ? 'selected' : '' }}>
                英文站
            </option>
        </select>
    </div>
</div>
