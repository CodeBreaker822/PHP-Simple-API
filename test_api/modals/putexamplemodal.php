
    <!-- Documentation Modal -->
    <div class="modal fade" id="documentationModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">PUT API Documentation</h5>
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
                                    <td><code>updateClass</code></td>
                                    <td>Full update of a class</td>
                                    <td>Capacity, Room_Type, Section, Teacher_ID</td>
                                </tr>
                                <tr>
                                    <td><code>updateGrade</code></td>
                                    <td>Full update of a grade</td>
                                    <td>Student_LRN, Advisory, Subject, Quarter1-4, school_year</td>
                                </tr>
                                <tr>
                                    <td><code>updateGradeLevel</code></td>
                                    <td>Full update of grade level</td>
                                    <td>Grade_Level, Grade 1-6</td>
                                </tr>
                                <tr>
                                    <td><code>updateInventory</code></td>
                                    <td>Full update of inventory item</td>
                                    <td>All inventory fields</td>
                                </tr>
                                <tr>
                                    <td><code>updateStudent</code></td>
                                    <td>Full update of student</td>
                                    <td>All student fields</td>
                                </tr>
                                <tr>
                                    <td><code>updateSubject</code></td>
                                    <td>Full update of subject</td>
                                    <td>All subject fields</td>
                                </tr>
                                <tr>
                                    <td><code>updateTeacher</code></td>
                                    <td>Full update of teacher</td>
                                    <td>All teacher fields</td>
                                </tr>
                                <tr>
                                    <td><code>updateTeacherFile</code></td>
                                    <td>Full update of teacher file</td>
                                    <td>All file fields</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h6 class="mt-4">Important Notes:</h6>
                    <ul>
                        <li>PUT requests require ALL fields to be provided (full update)</li>
                        <li>The ID of the record to update must be provided in the URL</li>
                        <li>Missing fields will result in an error</li>
                        <li>For partial updates, use PATCH instead</li>
                    </ul>

                    <p>Make sure to include jQuery library in your HTML before using this example:</p>
                    <pre><code>&lt;script src="https://code.jquery.com/jquery-3.6.0.min.js"&gt;&lt;/script&gt;</code></pre>

                    <h6 class="mt-4">Example Usage (updateClass):</h6>
                    <pre><code>PUT http://localhost/PhpAPI/api.php?request=updateClass&id=123&token=your_token

{
    "Capacity": 30,
    "Room_Type": 1,
    "Section": "A",
    "Teacher_ID": "T123"
}</code></pre>

                    <h6 class="mt-4">HTML Example:</h6>
<div class="bg-dark p-3 rounded">
    <pre><code class="language-html" style="color: #d4d4d4;">
&lt;form id=<span style="color: #ce9178">"updateClassForm"</span>&gt;
    &lt;div class=<span style="color: #ce9178">"mb-3"</span>&gt;
        &lt;label for=<span style="color: #ce9178">"classId"</span> class=<span style="color: #ce9178">"form-label"</span>&gt;Class ID:&lt;/label&gt;
        &lt;input type=<span style="color: #ce9178">"number"</span> class=<span style="color: #ce9178">"form-control"</span> id=<span style="color: #ce9178">"classId"</span> required&gt;
    &lt;/div&gt;
    &lt;div class=<span style="color: #ce9178">"mb-3"</span>&gt;
        &lt;label for=<span style="color: #ce9178">"capacity"</span> class=<span style="color: #ce9178">"form-label"</span>&gt;Capacity:&lt;/label&gt;
        &lt;input type=<span style="color: #ce9178">"number"</span> class=<span style="color: #ce9178">"form-control"</span> id=<span style="color: #ce9178">"capacity"</span> required&gt;
    &lt;/div&gt;
    &lt;div class=<span style="color: #ce9178">"mb-3"</span>&gt;
        &lt;label for=<span style="color: #ce9178">"roomType"</span> class=<span style="color: #ce9178">"form-label"</span>&gt;Room Type:&lt;/label&gt;
        &lt;input type=<span style="color: #ce9178">"number"</span> class=<span style="color: #ce9178">"form-control"</span> id=<span style="color: #ce9178">"roomType"</span> required&gt;
    &lt;/div&gt;
    &lt;div class=<span style="color: #ce9178">"mb-3"</span>&gt;
        &lt;label for=<span style="color: #ce9178">"section"</span> class=<span style="color: #ce9178">"form-label"</span>&gt;Section:&lt;/label&gt;
        &lt;input type=<span style="color: #ce9178">"text"</span> class=<span style="color: #ce9178">"form-control"</span> id=<span style="color: #ce9178">"section"</span> required&gt;
    &lt;/div&gt;
    &lt;div class=<span style="color: #ce9178">"mb-3"</span>&gt;
        &lt;label for=<span style="color: #ce9178">"teacherId"</span> class=<span style="color: #ce9178">"form-label"</span>&gt;Teacher ID:&lt;/label&gt;
        &lt;input type=<span style="color: #ce9178">"text"</span> class=<span style="color: #ce9178">"form-control"</span> id=<span style="color: #ce9178">"teacherId"</span> required&gt;
    &lt;/div&gt;
    &lt;button type=<span style="color: #ce9178">"submit"</span> class=<span style="color: #ce9178">"btn btn-primary"</span>&gt;Update Class&lt;/button&gt;
&lt;/form&gt;</code></pre>
</div>

                    <h6 class="mt-4">jQuery AJAX Example:</h6>
<div class="bg-dark p-3 rounded">
    <pre><code class="language-javascript" style="color: #d4d4d4;">
    <span style="color: #569cd6">$</span>(<span style="color: #dcdcaa">document</span>).<span style="color: #dcdcaa">ready</span>(<span style="color: #569cd6">function</span>() {
            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#updateClassForm'</span>).<span style="color: #dcdcaa">on</span>(<span style="color: #ce9178">'submit'</span>, <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">e</span>) {
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
                    <span style="color: #9cdcfe">url</span>: <span style="color: #ce9178">`http://localhost/PhpAPI/api.php?request=updateClass&id=${classId}&token=${token}`</span>,
                    <span style="color: #9cdcfe">method</span>: <span style="color: #ce9178">'PUT'</span>,
                    <span style="color: #9cdcfe">contentType</span>: <span style="color: #ce9178">'application/json'</span>,
                    <span style="color: #9cdcfe">data</span>: <span style="color: #4ec9b0">JSON</span>.<span style="color: #dcdcaa">stringify</span>({
                        <span style="color: #9cdcfe">Capacity</span>: <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#capacity'</span>).<span style="color: #dcdcaa">val</span>(),
                        <span style="color: #9cdcfe">Room_Type</span>: <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#roomType'</span>).<span style="color: #dcdcaa">val</span>(),
                        <span style="color: #9cdcfe">Section</span>: <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#section'</span>).<span style="color: #dcdcaa">val</span>(),
                        <span style="color: #9cdcfe">Teacher_ID</span>: <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#teacherId'</span>).<span style="color: #dcdcaa">val</span>()
                    }),
                    <span style="color: #9cdcfe">success</span>: <span style="color: #569cd6">function</span>(<span style="color: #9cdcfe">response</span>) {
                        <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#loader'</span>).<span style="color: #dcdcaa">hide</span>();
                        <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#responseData'</span>).<span style="color: #dcdcaa">html</span>(<span style="color: #4ec9b0">JSON</span>.<span style="color: #dcdcaa">stringify</span>(<span style="color: #9cdcfe">response</span>, <span style="color: #569cd6">null</span>, <span style="color: #b5cea8">2</span>));
                        
                        <span style="color: #c586c0">if</span> (<span style="color: #9cdcfe">response</span>.<span style="color: #9cdcfe">status</span> === <span style="color: #ce9178">'success'</span>) {
                            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#successMessage'</span>)
                                .<span style="color: #dcdcaa">text</span>(<span style="color: #9cdcfe">response</span>.<span style="color: #9cdcfe">message</span>)
                                .<span style="color: #dcdcaa">show</span>();
                            <span style="color: #569cd6">$</span>(<span style="color: #ce9178">'#updateClassForm'</span>)[<span style="color: #b5cea8">0</span>].<span style="color: #dcdcaa">reset</span>();
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
        <span style="color: #9cdcfe">"message"</span>: <span style="color: #ce9178">"Class updated successfully"</span>
    }

    <span style="color: #6a9955">// Error Response</span>
    {
        <span style="color: #9cdcfe">"status"</span>: <span style="color: #ce9178">"error"</span>,
        <span style="color: #9cdcfe">"message"</span>: <span style="color: #ce9178">"Error message here"</span>
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