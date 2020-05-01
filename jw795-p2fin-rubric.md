# Project 2, Final Submission Grade

NetID: [jw795]

100 points

Your final grade for Project 2 is based on grading the main learning outcomes in each milestone and on the final submission.


# Considerations

**INSTRUCTIONS:** Please be mindful of the circumstances that students were facing when this assignment was originally due.

**If you observe small mistakes that will cause a substantial loss in points (e.g. forgetting to submit secure/catalog.sqlite), please notify info2300-prof@cornell.edu.** We will notify the student and give them a chance to correct these small mistakes before grading continues.

Additionally, if you are concerned about a student, please notify the instructor.


# Design Process & Planning (20)

**INSTRUCTIONS: Grade in Markdown Preview. No credit for content not visible in Markdown Preview.**

## Catalog Planning
_full, half, or no credit_

- ( 2/ 2) Clearly explains the target audience(s).
- ( 2/ 2) Explains how the identified design patterns will be leveraged in the design of the catalog for improved usability.

**Catalog Planning Total: ( 4/ 4)**

## Website Planning
_full, half, or no credit_

- ( 4/ 4) Design process is thoroughly documented; a fellow 2300 student would be able to implement this website.
- ( 4/ 4) Demonstrates design evolution and different alternatives considered.

**Website Planning Total: ( 8/ 8)**

## Database Planning
_full, half, or no credit_

- ( 2/ 2) The planned queries are sensible and are generally correct.
- ( 2/ 2) The database query plan sufficient enough so that another programmer could code up the plan.

**Database Planning Total: ( 4/ 4)**

## Design Journey
_full, half, or no credit_

- ( 2/ 2) Design Journey communicates the student's reasoning and thoughts behind their design decisions. Design Journey does **not** just state what they did.
- ( 1/ 2) Responses are thorough and thoughtful. Writing is clear and concise.

**Design Journey Total: ( 3/ 4)**

## Design Process & Planning Total: ( 19/ 20)

> Explanation for points lost:
-1 No clear code planning

> What did the student do well?


> What needs improvement for future projects?



# Design (20)
_full, half, or no credit_

**INSTRUCTIONS: Run PHP Server from VS Code.**

## Catalog
_full, half, or no credit_

- ( 6/ 6) The design meets the needs of the target audience(s) and appropriately matches the theme of the catalog.
- ( 4/ 4) It is clear to target audiences when they are viewing the full collection and when they are viewing the results of a search

**Catalog Total: ( 10/ 10)**

## Visual Design
_full, half, or no credit_

- ( 4/ 4) Final design is aesthetically pleasing, pleasant to look at and use.
- ( 6/ 6) Website design properly employs visual design principles. **Examples:**
  - Alignment guides the user's eye through the design (avoids slight misalignments).
  - Sufficient contrast provided between text and background.
  - Proximity (margins/whitespace) is used to communicate relationships.
  - Typography is readable; centered text is used sparingly and appropriate where used.
  - Composition (layout) is usable; no overlapping elements.
  - Visual design elements are consistent and repeat throughout the site; consistent look and feel.
  - etc.

**Visual Design Total: ( 10/ 10)**

## Deductions
_full deduction; no partial deductions_

- ( / -10) Design first, then code not practiced; final implemented design differs _substantially_ from sketches (minor changes (e.g. changing label text) are acceptable).


## Design Total: ( 20/ 20)

> Explanation for points lost:


> What did the student do well?


> What needs improvement for future projects?



# Implementation (60)

**INSTRUCTIONS: Review code in VS Code. Grade schema in DB Browser for SQLite.**

## Database
_full, half, or no credit_

- ( 6/ 6) Database schema meets assignment requirements:
    - Contains only **one** table.
    - Minimum of 4 fields (excluding `id`).
    - Only conventional data types included; BLOB is prohibited.
    - Includes the web framework convention field, `id` as primary key.
- ( 4/ 4) Each field is properly constrained (PK, AI, U, Not Null).
- ( 4/ 4) Database follows standard conventions:
    - Table name is lowercase.
    - Fields are lowercase.
    - No spaces in field names; underscores are used instead.
- ( 4/ 4) There exists seed data with a minimum of 5 complete entries.

**Database Total: ( 18/ 18)**

## Searching Records
_full, half, or no credit_

- ( 4/ 4) Website allows user to view the entire collection of entries in the catalog at once.
- ( 4/ 4) Database records are properly escaped when writing out to HTML (e.g. `htmlspecialchars()`).
- ( 4/ 4) There is a functional search form returning search results from the database.
- ( 0/ 4) Users are able to search across multiple fields:
  - User may select between multiple fields in search form.
  - SQL query `SELECT`s across multiple fields (e.g. `OR`)
  - etc.
- ( 4/ 4) Search is implemented securely with filtered inputs and escaped outputs using parameter markers.

**Searching Records Total: ( 16/ 20)**

## Inserting Records
_full, half, or no credit_

- ( 6/ 6) The HTML form properly inserts user values into database.
- ( 4/ 4) Insert is implemented securely with filtered inputs and escaped outputs using parameter markers.

**Inserting Records Total: ( 10/ 10)**

## Best Practices
_full, half, or no credit_

- ( 6/ 6) Code makes effective use of functions. Minimum 2 user-defined functions required.
- ( 2/ 2) If appropriate, code makes effective use of partials (0 required).
- ( 4/ 4) Code (HTML, CSS, PHP, SQL) is readable, well structured, well formatted, and follows good coding practices.

**Best Practices Total: ( 12/ 12)**

## Deductions
_full deduction; no partial deductions_

- ( / -10) Implemented database differs substantially from planned schema.
- ( / -10) _(deduction)_ Algorithmic search instead of SQL (e.g. SELECT all records and filtered using PHP loop).
- ( / -10) PHP's PDO extension is not used for all database access (instructor provided functions use PDO).

**Deductions Total: (-0)**

## Implementation Total ( 56/ 60)

> Explanation for points lost:
-4 unable to search multiple fields

> What did the student do well?


> What needs improvement for future projects?



# Final Grade

## Deductions
_full deduction; no partial deductions_

- (-0) _(deduction)_ Plagiarism/Academic Integrity: includes code that is not the student's own work (includes code copied from lectures and labs).
  - **Note:** Email instructor directly before deducting any points.
- ( / -10) _(deduction)_ **-1 for each citation infringement** (up to -10) Citations: Content is not cited according to course policy.

**Deductions Total: (-0)**

> _Specific and detailed_ explanation for points deducted:


## Total

| Learning Outcome          | Grade      |
| ------------------------- | ---------- |
| Design Process & Planning | + ( 19/ 20)  |
| Design                    | + ( 20/ 20)  |
| Implementation            | + ( 56/ 60)  |
| Deductions                | - 0        |
| **Total**                 | = ( 95/ 100) |

> Additional grader comments:
