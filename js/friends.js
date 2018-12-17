$(function(){
    $(document).on('click', '.friendBtn',function(){
        var $this = $(this);
        var type = $this.data('type');
        
        switch(type){
            case 'addfriend':
                var id = $this.data('uid');
                
                if(id != ""){
                    $.post('/parse.php', {tags:'addFriend', uid: id}, function(data){
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
            
            case 'unfriend':
                var id = $this.data('uid');
                
                if(id != ""){
                    $.post('/parse.php', {tags:'unfriend', uid: id}, function(data){
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
            
            case 'accept':
                var id = $this.data('uid');
                
                if(id != ""){
                    $.post('/parse.php', {tags:'accept', uid: id}, function(data){
                        var obj = jQuery.parseJSON(data);
                        $this.text("Friend added!");
                        $this.attr('disabled', 'disabled');
                        //$(".ignore").attr('disabled', 'disabled');
                        /*if(obj.code == 1){
                            $this.text(obj.msg);
                            $this.attr('disabled', 'disabled');
                        }
                        else{
                            alert('Problem: ' +obj.msg);
                        }*/
                    });
                }
            break;
                
            case 'ignore':
                var id = $this.data('uid');
                
                if(id != ""){
                    $.post('/parse.php', {tags:'ignore', uid: id}, function(data){
                        var obj = jQuery.parseJSON(data);
                        $this.text("Ignored!");
                        $this.attr('disabled', 'disabled');   
                    });
                }
            break;
        }
    });
});