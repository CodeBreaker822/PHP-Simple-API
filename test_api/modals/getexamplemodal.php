
    <!-- Documentation Modal -->
    <div class="modal fade" id="documentationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">GET API Documentation</h5>
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
                                    <th>Response</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>getUsers</code></td>
                                    <td>Get all users (excluding sensitive data)</td>
                                    <td>Array of user objects</td>
                                </tr>
                                <tr>
                                    <td><code>getClass</code></td>
                                    <td>Get all classes</td>
                                    <td>Array of class objects</td>
                                </tr>
                                <tr>
                                    <td><code>getGrades</code></td>
                                    <td>Get all grades</td>
                                    <td>Array of grade objects</td>
                                </tr>
                                <tr>
                                    <td><code>getGradeLevels</code></td>
                                    <td>Get all grade levels</td>
                                    <td>Array of grade level objects</td>
                                </tr>
                                <tr>
                                    <td><code>getInventory</code></td>
                                    <td>Get all inventory items</td>
                                    <td>Array of inventory objects</td>
                                </tr>
                                <tr>
                                    <td><code>getParents</code></td>
                                    <td>Get all parents</td>
                                    <td>Array of parent objects</td>
                                </tr>
                                <tr>
                                    <td><code>getStudents</code></td>
                                    <td>Get all students</td>
                                    <td>Array of student objects</td>
                                </tr>
                                <tr>
                                    <td><code>getSubjects</code></td>
                                    <td>Get all subjects</td>
                                    <td>Array of subject objects</td>
                                </tr>
                                <tr>
                                    <td><code>getTeachers</code></td>
                                    <td>Get all teachers (excluding passwords)</td>
                                    <td>Array of teacher objects</td>
                                </tr>
                                <tr>
                                    <td><code>getTeacherFiles</code></td>
                                    <td>Get all teacher files</td>
                                    <td>Array of teacher file objects</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h6 class="mt-4">Note:</h6>
                    <p>Make sure to include jQuery library in your HTML before using this example:</p>
                    <pre><code>&lt;script src="https://code.jquery.com/jquery-3.6.0.min.js"&gt;&lt;/script&gt;</code></pre>

                    <h6 class="mt-4">Example Usage:</h6>
                    <pre><code>GET http://localhost/PhpAPI/api.php?request=getUsers&token=your_token</code></pre>

                    <h6 class="mt-4">HTML Example:</h6>
<div class="bg-dark p-3 rounded">
    <pre><code class="language-html" style="color: #d4d4d4;">
    &lt;div class=<span style="color: #ce9178">"container"</span>&gt;
        &lt;div class=<span style="color: #ce9178">"form-group"</span>&gt;
            &lt;label for=<span style="color: #ce9178">"apiToken"</span>&gt;API Token:&lt;/label&gt;
            &lt;input type=<span style="color: #ce9178">"text"</span> class=<span style="color: #ce9178">"form-control"</span> id=<span style="color: #ce9178">"apiToken"</span> placeholder=<span style="color: #ce9178">"Enter your API token"</span>&gt;
        &lt;/div&gt;
        &lt;pre id=<span style="color: #ce9178">"responseData"</span> class=<span style="color: #ce9178">"mt-3"</span>&gt;&lt;/pre&gt;
    &lt;/div&gt;
    </code></pre>
</div>
                    <h6 class="mt-4">jQuery AJAX Example:</h6>
<div class="bg-dark p-3 rounded">
    <pre><code class="language-javascript" style="color: #d4d4d4;">
    <span style="color: #569cd6">function</span> <span style="color: #dcdcaa">fetchData</span>(<span style="color: #9cdcfe">endpoint</span>) {
            <span style="color: #569cd6">const</span> <span style="color: #9cdcfe">token</span> = <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#apiToken'</span>).<span style="color: #dcdcaa">val</span>();
            
            <span style="color: #c586c0">if</span> (!<span style="color: #9cdcfe">token</span>) {
                <span style="color: #dcdcaa">showError</span>(<span style="color: #ce9178">'Please enter an API token'</span>);
                <span style="color: #c586c0">return</span>;
            }

            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">show</span>();
            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#errorMessage'</span>).<span style="color: #dcdcaa">hide</span>();
            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#responseData'</span>).<span style="color: #dcdcaa">empty</span>();

            <span style="color: #569cd6">$</span>.<span style="color: #dcdcaa">ajax</span>({
                <span style="color: #9cdcfe">url</span>: <span style="color: #ce9178">'http://localhost/PhpAPI/api.php'</span>,
                <span style="color: #9cdcfe">method</span>: <span style="color: #ce9178">'GET'</span>,
                <span style="color: #9cdcfe">data</span>: {
                    <span style="color: #9cdcfe">token</span>: <span style="color: #9cdcfe">token</span>,
                    <span style="color: #9cdcfe">request</span>: <span style="color: #ce9178">"getUsers"</span>
                },
                <span style="color: #9cdcfe">success</span>: <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">response</span>) {
                    <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">hide</span>();
                    <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#responseData'</span>).<span style="color: #dcdcaa">html</span>(<span style="color: #4ec9b0">JSON</span>.<span style="color: #dcdcaa">stringify</span>(<span style="color: #9cdcfe">response</span>, <span style="color: #569cd6">null</span>, <span style="color: #b5cea8">2</span>));
                },
                <span style="color: #9cdcfe">error</span>: <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">xhr</span>, <span style="color: #9cdcfe">status</span>, <span style="color: #9cdcfe">error</span>) {
                    <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">hide</span>();
                    <span style="color: #dcdcaa">showError</span>(<span style="color: #ce9178">'Error: '</span> + (<span style="color: #9cdcfe">xhr</span>.<span style="color: #9cdcfe">responseJSON</span>?.<span style="color: #9cdcfe">message</span> || <span style="color: #9cdcfe">error</span>));
                }
            });
        }

        <span style="color: #569cd6">function</span> <span style="color: #dcdcaa">showError</span>(<span style="color: #9cdcfe">message</span>) {
            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#errorMessage'</span>)
                .<span style="color: #dcdcaa">text</span>(<span style="color: #9cdcfe">message</span>)
                .<span style="color: #dcdcaa">show</span>();
        }
    </code></pre>
</div>
</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
