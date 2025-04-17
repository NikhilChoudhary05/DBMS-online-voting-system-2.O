<?php
include 'config.php';

echo "<pre>";
print_r($_POST); // Debug the form data
echo "</pre>";

if (isset($_POST['voter_id']) && isset($_POST['vote_choice'])) {
    $voter_id = $_POST['voter_id'];
    $vote_choice = $_POST['vote_choice'];

    // Check if voter exists
    $checkVoter = "SELECT * FROM Voters WHERE voter_id = ?";
    $stmt = $conn->prepare($checkVoter);
    $stmt->bind_param("i", $voter_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "❌ Invalid Voter ID!";
    } else {
        // Check if already voted
        $checkVote = "SELECT * FROM Votes WHERE voter_id = ?";
        $stmt = $conn->prepare($checkVote);
        $stmt->bind_param("i", $voter_id);
        $stmt->execute();
        $voteResult = $stmt->get_result();

        if ($voteResult->num_rows > 0) {
            echo "⚠️ You have already voted!";
        } else {
            $insert = "INSERT INTO Votes (voter_id, vote_choice) VALUES (?, ?)";
            $stmt = $conn->prepare($insert);
            $stmt->bind_param("is", $voter_id, $vote_choice);
            if ($stmt->execute()) {
                echo "✅ Vote successfully recorded!";
            } else {
                echo "❌ Error: " . $stmt->error;
            }
        }
    }

    $conn->close();
} else {
    echo "❌ Missing required fields!";
}
?>
