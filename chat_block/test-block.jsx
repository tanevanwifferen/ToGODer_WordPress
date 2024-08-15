/* This section of the code registers a new block, sets an icon and a category, and indicates what type of fields it'll include. */

wp.blocks.registerBlockType('brad/border-box', {
    title: 'ToGODer chat',
    icon: 'smiley',
    category: 'common',
    attributes: {
        content: {type: 'string'},
        color: {type: 'string'}
    },

    /* This configures how the content and color fields will work, and sets up the necessary elements */

    edit: function(props) {
        function updateContent(event) {
            props.setAttributes({content: event.target.value})
        }
        function updateColor(value) {
            props.setAttributes({color: value.hex})
        }
        return <div>
            <h3>Simple Box</h3>
            <input type="text" value={props.attributes.content} onChange={updateContent} />
            <wp.components.ColorPicker color={props.attributes.color} onChangeComplete={updateColor} />
        </div>;
    },
    save: function(props) {
        let newmessage = "";
        let messages = [];
        async function submit(){
            // send message to server
            messages.push(newmessage)
            const response = "hello";
            newmessage.push(response);
        }
        return <div>
            // messages
            <div>
                for (let message of messages){
                <p>
                    {message}
                </p>
                }
            </div>
            <textarea value={newmessage}></textarea>
            <button onSubmit={submit}>Submit</button>
        </div>;
    }
})