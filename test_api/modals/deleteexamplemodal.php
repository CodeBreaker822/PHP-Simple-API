<!-- Documentation Modal -->
<div class="modal fade" id="documentationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DELETE API Documentation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6>Available Endpoints:</h6>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Request</th>
                                <th>Description</th>
                                <th>Required Parameters</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>deleteClass</code></td>
                                <td>Delete a class by ID</td>
                                <td>id</td>
                            </tr>
                            <tr>
                                <td><code>deleteGrade</code></td>
                                <td>Delete a grade by ID</td>
                                <td>id</td>
                            </tr>
                            <tr>
                                <td><code>deleteStudent</code></td>
                                <td>Delete a student by ID</td>
                                <td>id</td>
                            </tr>
                            <tr>
                                <td><code>deleteTeacher</code></td>
                                <td>Delete a teacher by ID</td>
                                <td>id</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h6 class="mt-4">Note:</h6>
                <p>Make sure to include jQuery library in your HTML before using this example:</p>
                <pre><code>&lt;script src="https://code.jquery.com/jquery-3.6.0.min.js"&gt;&lt;/script&gt;</code></pre>

                <h6 class="mt-4">HTML Example:</h6>
                <div class="bg-dark p-3 rounded">
                    <pre><code class="language-html" style="color: #d4d4d4;">
&lt;form id=<span style="color: #ce9178">"deleteClassForm"</span>&gt;
    &lt;div class=<span style="color: #ce9178">"mb-3"</span>&gt;
        &lt;label for=<span style="color: #ce9178">"classId"</span> class=<span style="color: #ce9178">"form-label"</span>&gt;Class ID:&lt;/label&gt;
        &lt;input type=<span style="color: #ce9178">"number"</span> class=<span style="color: #ce9178">"form-control"</span> id=<span style="color: #ce9178">"classId"</span> required&gt;
    &lt;/div&gt;
    &lt;button type=<span style="color: #ce9178">"submit"</span> class=<span style="color: #ce9178">"btn btn-danger"</span>&gt;Delete Class&lt;/button&gt;
&lt;/form&gt;</code></pre>
                </div>

                <h6 class="mt-4">JavaScript Example:</h6>
                <div class="bg-dark p-3 rounded">
                    <pre><code class="language-javascript" style="color: #d4d4d4;">
        <span style="color: #569cd6">$</span>(<span style="color: #dcdcaa">document</span>).<span style="color: #dcdcaa">ready</span>(<span style="color: #569cd6">function</span>() {
                <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#deleteClassForm'</span>).<span style="color: #dcdcaa">on</span>(<span style="color: #ce9178">'submit'</span>, <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">e</span>) {
                    <span style="color: #9cdcfe">e</span>.<span style="color: #dcdcaa">preventDefault</span>();
                    
                    <span style="color: #569cd6">const</span> <span style="color: #9cdcfe">token</span> = <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#apiToken'</span>).<span style="color: #dcdcaa">val</span>();
                    <span style="color: #569cd6">const</span> <span style="color: #9cdcfe">classId</span> = <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#classId'</span>).<span style="color: #dcdcaa">val</span>();
                    
                    <span style="color: #c586c0">if</span> (!<span style="color: #9cdcfe">token</span>) {
                        <span style="color: #dcdcaa">showError</span>(<span style="color: #ce9178">'Please enter an API token'</span>);
                        <span style="color: #c586c0">return</span>;
                    }

                    <span style="color: #c586c0">if</span> (!<span style="color: #9cdcfe">classId</span>) {
                        <span style="color: #dcdcaa">showError</span>(<span style="color: #ce9178">'Please enter a Class ID'</span>);
                        <span style="color: #c586c0">return</span>;
                    }

                    <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">show</span>();
                    <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#errorMessage'</span>).<span style="color: #dcdcaa">hide</span>();
                    <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#successMessage'</span>).<span style="color: #dcdcaa">hide</span>();
                    <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#responseData'</span>).<span style="color: #dcdcaa">empty</span>();

                    <span style="color: #569cd6">$</span>.<span style="color: #dcdcaa">ajax</span>({
                        <span style="color: #9cdcfe">url</span>: <span style="color: #ce9178">`http://localhost/PhpAPI/api.php?request=deleteClass&id=${classId}&token=${token}`</span>,
                        <span style="color: #9cdcfe">method</span>: <span style="color: #ce9178">'DELETE'</span>,
                        <span style="color: #9cdcfe">success</span>: <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">response</span>) {
                            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">hide</span>();
                            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#responseData'</span>).<span style="color: #dcdcaa">html</span>(<span style="color: #4ec9b0">JSON</span>.<span style="color: #dcdcaa">stringify</span>(<span style="color: #9cdcfe">response</span>, <span style="color: #569cd6">null</span>, <span style="color: #b5cea8">2</span>));
                            
                            <span style="color: #c586c0">if</span> (<span style="color: #9cdcfe">response</span>.<span style="color: #9cdcfe">status</span> === <span style="color: #ce9178">'success'</span>) {
                                <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#successMessage'</span>)
                                    .<span style="color: #dcdcaa">text</span>(<span style="color: #9cdcfe">response</span>.<span style="color: #9cdcfe">message</span>)
                                    .<span style="color: #dcdcaa">show</span>();
                                <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#deleteClassForm'</span>)[<span style="color: #b5cea8">0</span>].<span style="color: #dcdcaa">reset</span>();
                            } <span style="color: #c586c0">else</span> {
                                <span style="color: #dcdcaa">showError</span>(<span style="color: #9cdcfe">response</span>.<span style="color: #9cdcfe">message</span>);
                            }
                        },
                        <span style="color: #9cdcfe">error</span>: <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">xhr</span>, <span style="color: #9cdcfe">status</span>, <span style="color: #9cdcfe">error</span>) {
                            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">hide</span>();
                            <span style="color: #dcdcaa">showError</span>(<span style="color: #ce9178">'Error: '</span> + (<span style="color: #9cdcfe">xhr</span>.<span style="color: #9cdcfe">responseJSON</span>?.<span style="color: #9cdcfe">message</span> || <span style="color: #9cdcfe">error</span>));
                        }
                    });
                });
            });

            <span style="color: #569cd6">function</span> <span style="color: #dcdcaa">showError</span>(<span style="color: #9cdcfe">message</span>) {
                <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#errorMessage'</span>)
                    .<span style="color: #dcdcaa">text</span>(<span style="color: #9cdcfe">message</span>)
                    .<span style="color: #dcdcaa">show</span>();
            }
    </code></pre>
                </div>

                <h6 class="mt-4">Response Format:</h6>
                <div class="bg-dark p-3 rounded">
                    <pre><code class="language-javascript" style="color: #d4d4d4;">
<span style="color: #6a9955">// Success Response</span>
{
    <span style="color: #9cdcfe">"status"</span>: <span style="color: #ce9178">"success"</span>,
    <span style="color: #9cdcfe">"message"</span>: <span style="color: #ce9178">"Class deleted successfully"</span>
}

<span style="color: #6a9955">// Error Response</span>
{
    <span style="color: #9cdcfe">"status"</span>: <span style="color: #ce9178">"error"</span>,
    <span style="color: #9cdcfe">"message"</span>: <span style="color: #ce9178">"Error message here"</span>
}</code></pre>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
