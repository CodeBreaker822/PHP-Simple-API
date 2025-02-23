  <!-- Documentation Modal -->
  <div class="modal fade" id="documentationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">POST API Documentation</h5>
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
                                    <th>Required Fields</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><code>addClass</code></td>
                                    <td>Create a new class</td>
                                    <td>Capacity, Room_Type, Section, Teacher_ID</td>
                                </tr>
                                <tr>
                                    <td><code>addGrade</code></td>
                                    <td>Add new grade for a student</td>
                                    <td>Student_LRN, Advisory, Subject, Quarter1-4, school_year</td>
                                </tr>
                                <tr>
                                    <td><code>addGradeLevel</code></td>
                                    <td>Create new grade level</td>
                                    <td>Grade_Level, Grade 1-6</td>
                                </tr>
                                <tr>
                                    <td><code>addInventory</code></td>
                                    <td>Add new inventory item</td>
                                    <td>inventory_no, Item_Name, Description, etc.</td>
                                </tr>
                                <tr>
                                    <td><code>addStudent</code></td>
                                    <td>Add new student</td>
                                    <td>Teacher_ID, Parents_ID, personal info, etc.</td>
                                </tr>
                                <tr>
                                    <td><code>addSubject</code></td>
                                    <td>Add new subject</td>
                                    <td>All subject fields (Mother_tongue, Mathematics, etc.)</td>
                                </tr>
                                <tr>
                                    <td><code>addTeacher</code></td>
                                    <td>Add new teacher</td>
                                    <td>Personal info, credentials, login details</td>
                                </tr>
                                <tr>
                                    <td><code>addTeacherFile</code></td>
                                    <td>Add new teacher file</td>
                                    <td>Teacher_ID, File details</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h6 class="mt-4">Note:</h6>
                    <p>Make sure to include jQuery library in your HTML before using this example:</p>
                    <pre><code>&lt;script src="https://code.jquery.com/jquery-3.6.0.min.js"&gt;&lt;/script&gt;</code></pre>

                    <h6 class="mt-4">Example Usage (addClass):</h6>
                    <pre><code><span style="color: #569cd6">POST</span> http://localhost/PhpAPI/api.php?request=addClass&token=your_token

{
    <span style="color: #9cdcfe">"Capacity"</span>: <span style="color: #b5cea8">30</span>,
    <span style="color: #9cdcfe">"Room_Type"</span>: <span style="color: #b5cea8">1</span>,
    <span style="color: #9cdcfe">"Section"</span>: <span style="color: #b5cea8">1</span>,
    <span style="color: #9cdcfe">"Teacher_ID"</span>: <span style="color: #ce9178">"T123"</span>
}</code></pre>

                    <h6 class="mt-4">HTML Form Example:</h6>
<div class="bg-dark p-3 rounded">
    <pre><code class="language-html" style="color: #d4d4d4;">
        <span style="color: #808080">&lt;!-- Add Class Form --></span>
        <span style="color: #569cd6">&lt;form</span> <span style="color: #9cdcfe">id=</span><span style="color: #ce9178">"addClassForm"</span><span style="color: #569cd6">></span>
            <span style="color: #569cd6">&lt;div</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"mb-3"</span><span style="color: #569cd6">></span>
                <span style="color: #569cd6">&lt;label</span> <span style="color: #9cdcfe">for=</span><span style="color: #ce9178">"capacity"</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"form-label"</span><span style="color: #569cd6">></span>Capacity:<span style="color: #569cd6">&lt;/label></span>
                <span style="color: #569cd6">&lt;input</span> <span style="color: #9cdcfe">type=</span><span style="color: #ce9178">"number"</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"form-control"</span> <span style="color: #9cdcfe">id=</span><span style="color: #ce9178">"capacity"</span> <span style="color: #9cdcfe">required</span><span style="color: #569cd6">></span>
            <span style="color: #569cd6">&lt;/div></span>
            <span style="color: #569cd6">&lt;div</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"mb-3"</span><span style="color: #569cd6">></span>
                <span style="color: #569cd6">&lt;label</span> <span style="color: #9cdcfe">for=</span><span style="color: #ce9178">"roomType"</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"form-label"</span><span style="color: #569cd6">></span>Room Type:<span style="color: #569cd6">&lt;/label></span>
                <span style="color: #569cd6">&lt;input</span> <span style="color: #9cdcfe">type=</span><span style="color: #ce9178">"number"</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"form-control"</span> <span style="color: #9cdcfe">id=</span><span style="color: #ce9178">"roomType"</span> <span style="color: #9cdcfe">required</span><span style="color: #569cd6">></span>
            <span style="color: #569cd6">&lt;/div></span>
            <span style="color: #569cd6">&lt;div</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"mb-3"</span><span style="color: #569cd6">></span>
                <span style="color: #569cd6">&lt;label</span> <span style="color: #9cdcfe">for=</span><span style="color: #ce9178">"section"</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"form-label"</span><span style="color: #569cd6">></span>Section:<span style="color: #569cd6">&lt;/label></span>
                <span style="color: #569cd6">&lt;input</span> <span style="color: #9cdcfe">type=</span><span style="color: #ce9178">"number"</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"form-control"</span> <span style="color: #9cdcfe">id=</span><span style="color: #ce9178">"section"</span> <span style="color: #9cdcfe">required</span><span style="color: #569cd6">></span>
            <span style="color: #569cd6">&lt;/div></span>
            <span style="color: #569cd6">&lt;div</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"mb-3"</span><span style="color: #569cd6">></span>
                <span style="color: #569cd6">&lt;label</span> <span style="color: #9cdcfe">for=</span><span style="color: #ce9178">"teacherId"</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"form-label"</span><span style="color: #569cd6">></span>Teacher ID:<span style="color: #569cd6">&lt;/label></span>
                <span style="color: #569cd6">&lt;input</span> <span style="color: #9cdcfe">type=</span><span style="color: #ce9178">"text"</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"form-control"</span> <span style="color: #9cdcfe">id=</span><span style="color: #ce9178">"teacherId"</span> <span style="color: #9cdcfe">required</span><span style="color: #569cd6">></span>
            <span style="color: #569cd6">&lt;/div></span>
            <span style="color: #569cd6">&lt;button</span> <span style="color: #9cdcfe">type=</span><span style="color: #ce9178">"submit"</span> <span style="color: #9cdcfe">class=</span><span style="color: #ce9178">"btn btn-primary"</span><span style="color: #569cd6">></span>Add Class<span style="color: #569cd6">&lt;/button></span>
        <span style="color: #569cd6">&lt;/form></span></code></pre>
</div>

                    <h6 class="mt-4">jQuery AJAX Example:</h6>
<div class="bg-dark p-3 rounded">
    <pre><code class="language-javascript" style="color: #d4d4d4;">
    <span style="color: #9cdcfe">$</span>.<span style="color: #dcdcaa">ready</span>(<span style="color: #569cd6">function</span>() {
            <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#addClassForm'</span>).<span style="color: #dcdcaa">on</span>(<span style="color: #ce9178">'submit'</span>, <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">e</span>) {
                <span style="color: #9cdcfe">e</span>.<span style="color: #dcdcaa">preventDefault</span>();
                
                <span style="color: #569cd6">const</span> <span style="color: #9cdcfe">token</span> = <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#apiToken'</span>).<span style="color: #dcdcaa">val</span>();
                <span style="color: #c586c0">if</span> (!token) {
                    <span style="color: #dcdcaa">showError</span>(<span style="color: #ce9178">'Please enter an API token'</span>);
                    <span style="color: #c586c0">return</span>;
                }

                <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">show</span>();
                <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#errorMessage'</span>).<span style="color: #dcdcaa">hide</span>();
                <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#successMessage'</span>).<span style="color: #dcdcaa">hide</span>();
                <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#responseData'</span>).<span style="color: #dcdcaa">empty</span>();

                <span style="color: #9cdcfe">$</span>.<span style="color: #dcdcaa">ajax</span>({
                    <span style="color: #9cdcfe">url</span>: <span style="color: #ce9178">'http://localhost/PhpAPI/api.php?request=addClass&token='</span>+token, //for server https://yourdomain.com/PhpAPI/api.php?request=addClass&token=your_token
                    <span style="color: #9cdcfe">method</span>: <span style="color: #ce9178">'POST'</span>,
                    <span style="color: #9cdcfe">data</span>: {
                        <span style="color: #9cdcfe">Capacity</span>: <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#capacity'</span>).<span style="color: #dcdcaa">val</span>(),
                        <span style="color: #9cdcfe">Room_Type</span>: <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#roomType'</span>).<span style="color: #dcdcaa">val</span>(),
                        <span style="color: #9cdcfe">Section</span>: <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#section'</span>).<span style="color: #dcdcaa">val</span>(),
                        <span style="color: #9cdcfe">Teacher_ID</span>: <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#teacherId'</span>).<span style="color: #dcdcaa">val</span>()
                    },
                    <span style="color: #dcdcaa">success</span>: <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">response</span>) {
                        <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">hide</span>();
                        <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#responseData'</span>).<span style="color: #dcdcaa">html</span>(<span style="color: #4ec9b0">JSON</span>.<span style="color: #dcdcaa">stringify</span>(response, <span style="color: #569cd6">null</span>, <span style="color: #b5cea8">2</span>));
                        
                        <span style="color: #c586c0">if</span> (response.<span style="color: #9cdcfe">status</span> === <span style="color: #ce9178">'success'</span>) {
                            <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#successMessage'</span>)
                                .<span style="color: #dcdcaa">text</span>(response.<span style="color: #9cdcfe">message</span>)
                                .<span style="color: #dcdcaa">show</span>();
                            <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#addClassForm'</span>)[<span style="color: #b5cea8">0</span>].<span style="color: #dcdcaa">reset</span>();
                        } <span style="color: #c586c0">else</span> {
                            <span style="color: #dcdcaa">showError</span>(response.<span style="color: #9cdcfe">message</span>);
                        }
                    },
                    <span style="color: #dcdcaa">error</span>: <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">xhr</span>, <span style="color: #9cdcfe">status</span>, <span style="color: #9cdcfe">error</span>) {
                        <span style="color: #9cdcfe">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">hide</span>();
                        <span style="color: #dcdcaa">showError</span>(<span style="color: #ce9178">'Error: '</span> + (xhr.responseJSON?.<span style="color: #9cdcfe">message</span> || error));
                    }
                });
            });
        });
    </code></pre>
</div>

                    <h6 class="mt-4">Response Format:</h6>
<div class="bg-dark p-3 rounded">
    <pre><code class="language-javascript" style="color: #d4d4d4;">
    // Success Response
    {
        "status": "success",
        "message": "Class created successfully",
        "id": 123
    }

    // Error Response
    {
        "status": "error",
        "message": "Error message here"
    }
    </code></pre>
</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>