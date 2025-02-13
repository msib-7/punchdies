<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <h3>Pengukuran Awal</h3>
            </div>
            <hr>
            <div class="col-12 col-md-4">
                <div class="row">
                    <div class="col-12">Punch Atas</div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Column Name</th>
                                    <th>Value</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Head Outer Diameter</td>
                                        <td>
                                            <input type="number" class="form-control" name="head_outer_diameter_atas" id="head_outer_diameter_atas" value="{{ $punch_atas_awal->head_outer_diameter ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Neck Diameter</td>
                                        <td>
                                            <input type="number" class="form-control" name="neck_diameter_atas" id="neck_diameter_atas" value="{{ $punch_atas_awal->neck_diameter ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Barrel</td>
                                        <td>
                                            <input type="number" class="form-control" name="barrel_atas" id="barrel_atas" value="{{ $punch_atas_awal->barrel ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Overall Length</td>
                                        <td>
                                            <input type="number" class="form-control" name="overall_length_atas" id="overall_length_atas" value="{{ $punch_atas_awal->overall_length ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tip Diameter 1</td>
                                        <td>
                                            <input type="number" class="form-control" name="tip_diameter_1_atas" id="tip_diameter_1_atas" value="{{ $punch_atas_awal->tip_diameter_1 ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tip Diameter 2</td>
                                        <td>
                                            <input type="number" class="form-control" name="tip_diameter_2_atas" id="tip_diameter_2_atas" value="{{ $punch_atas_awal->tip_diameter_2 ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cup Depth</td>
                                        <td>
                                            <input type="number" class="form-control" name="cup_depth_atas" id="cup_depth_atas" value="{{ $punch_atas_awal->cup_depth ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Working Length</td>
                                        <td>
                                            <input type="number" class="form-control" name="working_length_atas" id="working_length_atas" value="{{ $punch_atas_awal->working_length ?? '0' }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="row">
                    <div class="col-12">Punch Bawah</div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Column Name</th>
                                    <th>Value</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Head Outer Diameter</td>
                                        <td>
                                            <input type="number" class="form-control" name="head_outer_diameter_bawah" id="head_outer_diameter_bawah" value="{{ $punch_bawah_awal->head_outer_diameter ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Neck Diameter</td>
                                        <td>
                                            <input type="number" class="form-control" name="neck_diameter_bawah" id="neck_diameter_bawah" value="{{ $punch_bawah_awal->neck_diameter ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Barrel</td>
                                        <td>
                                            <input type="number" class="form-control" name="barrel_bawah" id="barrel_bawah" value="{{ $punch_bawah_awal->barrel ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Overall Length</td>
                                        <td>
                                            <input type="number" class="form-control" name="overall_length_bawah" id="overall_length_bawah" value="{{ $punch_bawah_awal->overall_length ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tip Diameter 1</td>
                                        <td>
                                            <input type="number" class="form-control" name="tip_diameter_1_bawah" id="tip_diameter_1_bawah" value="{{ $punch_bawah_awal->tip_diameter_1 ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tip Diameter 2</td>
                                        <td>
                                            <input type="number" class="form-control" name="tip_diameter_2_bawah" id="tip_diameter_2_bawah" value="{{ $punch_bawah_awal->tip_diameter_2 ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cup Depth</td>
                                        <td>
                                            <input type="number" class="form-control" name="cup_depth_bawah" id="cup_depth_bawah" value="{{ $punch_bawah_awal->cup_depth ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Working Length</td>
                                        <td>
                                            <input type="number" class="form-control" name="working_length_bawah" id="working_length_bawah" value="{{ $punch_bawah_awal->working_length ?? '0' }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="row">
                    <div class="col-12">Dies</div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Column Name</th>
                                    <th>Value</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Outer Diameter</td>
                                        <td>
                                            <input type="number" class="form-control" name="outer_diameter" id="outer_diameter" value="{{ $dies_awal->outer_diameter ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inner Diameter 1</td>
                                        <td>
                                            <input type="number" class="form-control" name="inner_diameter_1" id="inner_diameter_1" value="{{ $dies_awal->inner_diameter_1 ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Inner Diameter 2</td>
                                        <td>
                                            <input type="number" class="form-control" name="inner_diameter_2" id="inner_diameter_2" value="{{ $dies_awal->inner_diameter_2 ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ketinggian Dies</td>
                                        <td>
                                            <input type="number" class="form-control" name="ketinggian_dies" id="ketinggian_dies" value="{{ $dies_awal->ketinggian_dies ?? '0' }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <h3>Pengukuran Rutin</h3>
            </div>
            <hr>
            <div class="col-12 col-md-4">
                <div class="row">
                    <div class="col-12">Punch Atas</div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Column Name</th>
                                    <th>Value</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Overall Length</td>
                                        <td>
                                            <input type="number" class="form-control" name="overall_length_rutin_atas" id="overall_length_rutin_atas" value="{{ $punch_atas_rutin->overall_length ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Working Length <b>(Rutin)</b></td>
                                        <td>
                                            <input type="number" class="form-control" name="working_length_rutin_atas" id="working_length_rutin_atas" value="{{ $punch_atas_rutin->working_length ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cup Depth</td>
                                        <td>
                                            <input type="number" class="form-control" name="cup_depth_rutin_atas" id="cup_depth_rutin_atas" value="{{ $punch_atas_rutin->cup_depth ?? '0' }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="row">
                    <div class="col-12">Punch Bawah</div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Column Name</th>
                                    <th>Value</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Overall Length</td>
                                        <td>
                                            <input type="number" class="form-control" name="overall_length_rutin_bawah" id="overall_length_rutin_bawah" value="{{ $punch_bawah_rutin->overall_length ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Working Length <b>(Rutin)</b></td>
                                        <td>
                                            <input type="number" class="form-control" name="working_length_rutin_bawah" id="working_length_rutin_bawah" value="{{ $punch_bawah_rutin->working_length ?? '0' }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cup Depth</td>
                                        <td>
                                            <input type="number" class="form-control" name="cup_depth_rutin_bawah" id="cup_depth_rutin_bawah" value="{{ $punch_bawah_rutin->cup_depth ?? '0' }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="row">
                    {{-- <div class="col-12">Dies</div> --}}
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>