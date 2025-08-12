in admin slides page 

 <select name="page" class="form-select" required>
            <option value="">Choose…</option>
            <option <?= ($e['page'] == 'home') ? 'selected' : '' ?> value="home">Home</option>
            <option <?= ($e['page'] == 'schools') ? 'selected' : '' ?> value="schools">Schools</option>
            <option <?= ($e['page'] == 'colleges') ? 'selected' : '' ?> value="colleges">Colleges</option>
          </select>

this is not working pages urls or of two types in my website 