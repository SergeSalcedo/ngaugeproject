$(function(){
    $(document).on('click', '.gameBtn',function(){
        var $this = $(this);
        var type = $this.data('type');
        
        switch(type){
            case 'addgame':
                var g_id = $this.data('gid');
                
                if(g_id != ""){
                    $.post('parsegames.php', {tags:'addGame', G_ID: g_id}, function(data){
                        var obj = jQuery.parseJSON(data);
                        
                        if(obj.code == 1){
                            $this.text(obj.msg);
                            $this.attr('disabled', 'disabled');
                        }
                        else{
                            alert('Problem: ' +obj.msg);
                        }
                    });
                }
            break;
            
            case 'remove':
                var g_id = $this.data('gid');
                
                if(g_id != ""){
                    $.post('parsegames.php', {tags:'remove', G_ID: g_id}, function(data){
                        var obj = jQuery.parseJSON(data);
                        
                        if(obj.code == 1){
                            $this.text(obj.msg);
                            $this.attr('disabled', 'disabled');
                        }
                        else{
                            alert('Problem: ' +obj.msg);
                        }
                    });
                }
            break;
            
            
        }
    });
});