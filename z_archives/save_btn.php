                <button type="submit" class="btn btn-green" value="Save Record">
                    <?= ucfirst($mode) ?> Record
                </button>
                <a class="btn btn-red-outline" href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>">Cancel</a>