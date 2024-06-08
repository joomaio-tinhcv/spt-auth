<tr>
    <td>
        <?php if($this->item['allow']) : ?>
        <input class="checkbox-item"  type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
        <?php endif;?>
    </td>
    <td>
        <?php if($this->item['allow']) : ?>
        <a class="fs-4 me-1 show_data" 
            href="<?php echo $this->link_form.'/'. $this->item['id']; ?>"
            >
            <?php echo $this->item['title'] ?>
        </a>
        <?php else:?>
            <?php echo $this->item['title'] ?>
        <?php endif;?>
    </td>
    <td>
        <?php echo $this->item['created_at'] ?>
    </td>
</tr>