  var Delete= React.createClass({

         delete: function() {
      $.ajax({
        url: this.props.source,
        type:'DELETE',
        success: function() {
          alert("Post has been deleted");
        }.bind(this),
        
      });
    },

            render: function(){
                return (   
                   <button onClick={this.delete}>Delete</button>
                   

                    );
            }
        });

        React.render(<Delete source="/instructor_home/posts/{{$post->id}}"/>, document.getElementById("{{ $post_id}}"));
          