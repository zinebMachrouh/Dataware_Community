SELECT questions.*, tags.name AS tags_name FROM questions
INNER JOIN tag_question
INNER JOIN tags
WHERE questions.id = 6



(this one for modify question)

    SELECT tag_question.*, questions.id FROM tag_question
    INNER JOIN questions
    INNER JOIN tags
    WHERE questions.id = 6


//working query

select tag_question.* from tag_question
JOIN questions q ON tag_question.question_id = q.id
Where q.id = 6;
