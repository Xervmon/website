jQuery(document).ready(function(){ 
	jQuery('.nvr_add_section_button').click(function(evt){
		evt.preventDefault();
		var currentid = jQuery(this).attr('href');
		var currentsection = '#sectionbuilder'+currentid;
		var sectionrowcounter = jQuery('#sectionrowcounter'+ currentid);
		var counterval = parseInt(sectionrowcounter.val());
		var currentcounter = parseInt(counterval)+1;
		var section = jQuery(currentsection);
		
		var sectionskeleton = '';
		sectionskeleton += '<div class="nvr_sectionrow" id="nvr_sectionrow'+currentid+'_'+currentcounter+'">';
		sectionskeleton += '<a class="button nvr_remove_section_button" href="#nvr_sectionrow'+currentid+'_'+currentcounter+'">Remove Section</a>';
		sectionskeleton += '<table class="nvr_sectiontable" cellpadding="0" cellspacing="0" border="0">';
			sectionskeleton += '<tr>';
				sectionskeleton += '<td class="small"><label>BG Color</label><br /><input type="text" name="'+currentid+'['+counterval+'][backgroundcolor]" value="" /></td>';
				sectionskeleton += '<td class="large"><label>BG Image</label><br /><input type="text" name="'+currentid+'['+counterval+'][background]" value="" /></td>';
				sectionskeleton += '<td class="small"><label>Custom Class</label><br /><input type="text" name="'+currentid+'['+counterval+'][customclass]" value=""></td>';
			sectionskeleton += '</tr>';
			sectionskeleton += '<tr>';
				sectionskeleton += '<td colspan="3"><label>Content</label><br /><textarea name="'+currentid+'['+counterval+'][content]" rows="6"></textarea></td>';
			sectionskeleton += '</tr>';
		sectionskeleton += '</table>';
		sectionskeleton += '</div>';
		
		section.append(sectionskeleton);
		sectionrowcounter.val(currentcounter);
		section_remove_button();
	});
	
	section_remove_button();
});

function section_remove_button(){
	jQuery('.nvr_remove_section_button').click(function(evt){
		evt.preventDefault();
		var currentsectionid = jQuery(this).attr('href');
		jQuery(currentsectionid).remove();
	});
}