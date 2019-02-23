<div class="container">
    <h5>Number of Dice</h5>
    <div class="row">
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_1" value="1" checked>
                <label class="form-check-label" for="dice_num_1">1</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_2" value="2">
                <label class="form-check-label" for="dice_num_2">2</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_3" value="3">
                <label class="form-check-label" for="dice_num_3">3</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_4" value="4">
                <label class="form-check-label" for="dice_num_4">4</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_5" value="5">
                <label class="form-check-label" for="dice_num_5">5</label>
            </div>
        </div>
        <div class="col-2 border-top border-left border-right rounded p-1">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="other_num" value="11">
                <label class="form-check-label" for="other_num">Other</label>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_6" value="6">
                <label class="form-check-label" for="dice_num_1">6</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_7" value="7">
                <label class="form-check-label" for="dice_num_7">7</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_8" value="8">
                <label class="form-check-label" for="dice_num_8">8</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_9" value="9">
                <label class="form-check-label" for="dice_num_9">9</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_num" id="dice_num_10" value="10">
                <label class="form-check-label" for="dice_num_10">10</label>
            </div>
        </div>
        <div class="col-2 border-bottom border-left border-right rounded p-1">
            <div class="form-group">
                <input class="form-control" type="text" name="other_dice_num" id="other_dice_num" value="">
            </div>
        </div>
    </div>
    <h5>Type of Dice</h5>
    <div class="row mb-3">
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_type" id="dice_type_d4" value="4" checked>
                <label class="form-check-label" for="dice_type_d4">D4</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_type" id="dice_type_d6" value="6">
                <label class="form-check-label" for="dice_type_d6">D6</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_type" id="dice_type_d8" value="7">
                <label class="form-check-label" for="dice_type_d8">D8</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_type" id="dice_type_d10" value="10">
                <label class="form-check-label" for="dice_type_d10">D10</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_type" id="dice_type_d12" value="12">
                <label class="form-check-label" for="dice_type_d12">D12</label>
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="dice_type" id="dice_type_d20" value="20">
                <label class="form-check-label" for="dice_type_d20">D20</label>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4">
            <div class="form-group">
                <label for="dice_mod">Modifier</label>
                <input type="text" name="dice_mod" id="dice_mod" class="form-control" value="0" />
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-4 justify-content-center">
            <button type="button" class="btn btn-primary" onclick="rollDice()">Roll!</button>
        </div>
        <div class="col-4 justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
        </div>
    </div>
</div>